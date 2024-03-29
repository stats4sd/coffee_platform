<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Source;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Source::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'reference' => $this->faker->sentence(2),
            'partner_id' => Partner::factory(),
            'description' => $this->faker->paragraph(5),
            'is_not_public' => $this->faker->boolean,
        ];
    }
}
