<?php

namespace Tests\Unit;

use App\Jobs\UpdateUserWeather;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class UpdateWeatherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_weather_for_all_users_one_by_one(): void
    {
        Bus::fake(UpdateUserWeather::class);
        User::factory(20)->create();

        $this->artisan('weather:update');

        Bus::assertDispatchedTimes(UpdateUserWeather::class, 20);
    }
}
