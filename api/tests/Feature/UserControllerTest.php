<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Generator;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_users_and_their_current_weather(): void
    {
        User::factory(10)->hasWeather()->create();

        $response = $this->get('/users');

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', 10, fn ($json) => $json
                        ->hasAll(
                            'name',
                            'email',
                            'latitude',
                            'longitude',
                            'weather.short',
                            'weather.temperature',
                            'created_at'
                        )
                    )->etc()
            );
    }

    /**
     * @test
     * @dataProvider providePagination
     */
    public function it_lists_users_paginated($expectedPerPage, $per_page)
    {
        User::factory($expectedPerPage + 2)->hasWeather()->create();

        $response = $this->json('get', '/users', compact('per_page'));

        $response
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', $expectedPerPage)
                    ->hasAll('links', 'meta')
                    ->etc(),
            );
    }

    /** @test */
    public function it_shows_a_user_and_his_current_weather(): void
    {
        $user = User::factory()->hasWeather()->create()->fresh();

        $response = $this->getJson("/users/$user->id");

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->whereAll([
                        'data' => [
                            'name' => $user->name,
                            'email' => $user->email,
                            'latitude' => $user->latitude,
                            'longitude' => $user->longitude,
                            'weather' => [
                                'short' => $user->weather->short,
                                'full' => $user->weather->full,
                                'temperature' => $user->weather->temperature,
                                'perception' => $user->weather->perception,
                                'precipitation' => $user->weather->precipitation,
                                'humidity' => $user->weather->humidity,
                                'wind' => $user->weather->wind,
                                'pressure' => $user->weather->pressure,
                                'measured_at' => $user->weather->updated_at->toISOString(),
                            ],
                            'created_at' => $user->created_at->toISOString(),
                        ],
                    ])
                    ->etc()
            );;
    }

    public function providePagination(): Generator
    {
        yield 'Specified `per_page` is used' => [5, 5];

        yield 'Default `per_page` is used when not specified' => [15, null];
    }
}
