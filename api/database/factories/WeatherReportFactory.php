<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeatherReport>
 */
class WeatherReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'temperature' => $this->faker->randomFloat(2, -100, 100),
            'perception' => $this->faker->randomFloat(2, -100, 100),
            'precipitation' => $this->faker->randomFloat(2, 0, 100),
            'humidity' => $this->faker->randomFloat(2, 0, 100),
            'wind' => $this->faker->randomFloat(2, 0, 100),
            'pressure' => $this->faker->randomFloat(2, 0, 100),
            'short' => $this->faker->word(),
            'full' => $this->faker->sentence(4),
        ];
    }
}
