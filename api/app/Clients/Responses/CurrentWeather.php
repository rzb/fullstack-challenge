<?php

namespace App\Clients\Responses;

class CurrentWeather
{
    public function __construct(
        public float|null $temperature,
        public float|null $perception,
        public float|null $precipitation,
        public float|null $humidity,
        public float|null $wind,
        public float|null $pressure,
        public string $short,
        public string $full,
    ) {}
}
