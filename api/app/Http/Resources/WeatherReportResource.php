<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'short' => $this->short,
            'full' => $this->full,
            'temperature' => $this->temperature,
            'perception' => $this->perception,
            'precipitation' => $this->precipitation,
            'humidity' => $this->humidity,
            'wind' => $this->wind,
            'pressure' => $this->pressure,
            'measured_at' => $this->updated_at,
        ];
    }
}
