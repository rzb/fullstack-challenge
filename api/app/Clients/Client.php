<?php

namespace App\Clients;

use App\Clients\Responses\CurrentWeather;
use App\Models\User;

interface Client
{
    public function currentWeather(User $user): CurrentWeather;
}
