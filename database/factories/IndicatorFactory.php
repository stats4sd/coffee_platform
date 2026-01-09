<?php

namespace Database\Factories;

use App\Models\SubCharacteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndicatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_characteristic_id' => SubCharacteristic::factory(),
            'code' => $this->faker->randomLetter().$this->faker->unique()->numberBetween(0, 10000),
            'name' => $this->faker->sentence(5),
        ];
    }
}
