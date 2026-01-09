<?php

namespace Database\Factories;

use App\Models\PurposeOfCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurposeOfCollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
        ];
    }
}
