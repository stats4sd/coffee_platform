<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
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
            'type_id' => Type::factory(),
        ];
    }
}
