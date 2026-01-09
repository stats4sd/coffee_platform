<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SmallholderDefinitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'definition' => $this->faker->paragraph(5),
        ];
    }
}
