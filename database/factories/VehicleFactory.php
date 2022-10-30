<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'model' => fake()->name(),
            'brand' => fake()->name(),
            'plate' => substr(md5(rand(5,5)), 0, 7),
            'year'  => fake()->year(),
        ];
    }
}
