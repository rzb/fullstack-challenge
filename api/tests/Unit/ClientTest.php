<?php

namespace Tests\Unit;

use App\Clients\Client;
use App\Clients\Responses\CurrentWeather;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function it_checks_the_current_weather_for_a_user(): void
    {
        $user = User::factory()->make();

        try {
            app(Client::class)->currentWeather($user);
        } catch (Exception $e) {
            $this->fail('Failed to hit the API. ' . $e->getMessage());
        }

        $this->assertTrue(true);
    }

    /** @test */
    public function it_creates_the_normalized_current_weather_response(): void
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

        $weather = app(Client::class)->currentWeather(User::factory()->make());

        $this->assertInstanceOf(CurrentWeather::class, $weather);
        $this->assertEquals(298.48, $weather->temperature);
        $this->assertEquals(298.74, $weather->perception);
        $this->assertEquals(3.16, $weather->precipitation);
        $this->assertEquals(64, $weather->humidity);
        $this->assertEquals(0.62, $weather->wind);
        $this->assertEquals(1015, $weather->pressure);
        $this->assertEquals('Rain', $weather->short);
        $this->assertEquals('moderate rain', $weather->full);
    }
}
