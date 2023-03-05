<?php

namespace Tests\Unit;

use App\Jobs\UpdateUserWeather;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UpdateUserWeatherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_weather_for_a_user(): void
    {
        Http::fake(fn() => [
            'main' => [
                'temp' => 298.48,
                'feels_like' => 298.74,
                'pressure' => 1015,
                'humidity' => 64,
            ],
            'rain' => [
                '1h' => 3.16,
            ],
            'wind' => [
                'speed' => 0.62,
            ],
            'weather' => [
                [
                    'main' => 'Rain',
                    'description' => 'moderate rain',
                ]
            ],
        ]);
        $user = User::factory()->create();

        UpdateUserWeather::dispatch($user);

        $this->assertDatabaseHas('weather_reports', [
            'user_id' => $user->id,
            'temperature' => 298.48,
            'perception' => 298.74,
            'precipitation' => 3.16,
            'humidity' => 64,
            'wind' => 0.62,
            'pressure' => 1015,
            'short' => 'Rain',
            'full' => 'moderate rain',
        ]);
    }

    /** @test */
    public function it_correctly_cleans_up_attributes_that_have_not_been_measured_in_the_current_weather_report(): void
    {
        $user = User::factory()->hasWeather()->create();
        Http::fake(fn() => [
            'main' => [
                'temp' => 298.48,
                'feels_like' => 298.74,
            ],
            'weather' => [
                [
                    'main' => 'Rain',
                    'description' => 'moderate rain',
                ],
            ],
        ]);

        UpdateUserWeather::dispatch($user);

        $this->assertDatabaseHas('weather_reports', [
            'user_id' => $user->id,
            'precipitation' => null,
            'humidity' => null,
            'wind' => null,
            'pressure' => null,
        ]);
    }
}
