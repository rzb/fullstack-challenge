<?php

namespace App\Clients;

use App\Clients\Responses\CurrentWeather;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class OpenWeather implements Client
{
    protected const BASE_URL = 'https://api.openweathermap.org/data/2.5';

    public function currentWeather(User $user): CurrentWeather
    {
        $response = Http::get($this->endpoint(
            'weather', $user->latitude, $user->longitude)
        );

        return new CurrentWeather(
            temperature: $response->json('main.temp'),
            perception: $response->json('main.feels_like'),
            precipitation: $response->json('rain.1h'),
            humidity: $response->json('main.humidity'),
            wind: $response->json('wind.speed'),
            pressure: $response->json('main.pressure'),
            short: $response->json('weather.0.main'),
            full: $response->json('weather.0.description'),
        );
    }

    protected function endpoint(string $subject, float $lat, float $lon): string
    {
        $appid = config('services.clients.openWeather.key');

        $units = 'imperial';

        $params = Arr::query(compact('lat', 'lon', 'appid', 'units'));

        return self::BASE_URL . "/{$subject}?$params";
    }
}
