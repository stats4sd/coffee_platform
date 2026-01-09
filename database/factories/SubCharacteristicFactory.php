<?php

namespace Database\Factories;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'characteristic_id' => Characteristic::factory(),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
