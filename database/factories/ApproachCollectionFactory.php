<?php

namespace Database\Factories;

use App\Models\ApproachCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApproachCollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApproachCollection::class;

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
