<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Country;
use App\Models\Department;
use App\Models\GeoBoundary;
use App\Models\Muncipality;
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
            'region_id' => Region::factory(),
            'muncipality_id' => Muncipality::factory(),
            'department_id' => Department::factory(),
            'description' => $this->faker->unique()->word(),
            'altitude' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
