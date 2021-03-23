<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\GeoBoundary;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeoBoundaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GeoBoundary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => Country::factory(),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
