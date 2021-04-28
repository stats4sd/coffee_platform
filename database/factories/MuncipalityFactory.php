<?php

namespace Database\Factories;

use App\Models\Muncipality;
use Illuminate\Database\Eloquent\Factories\Factory;

class MuncipalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Muncipality::class;

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
