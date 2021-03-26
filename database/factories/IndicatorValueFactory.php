<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\User;
use App\Models\Gender;
use App\Models\Source;
use App\Models\Indicator;
use App\Models\GeoBoundary;
use App\Models\IndicatorValue;
use App\Models\ApproachCollection;
use App\Models\PurposeOfCollection;
use App\Models\SmallholderDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndicatorValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IndicatorValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2, -100, 1000),
            'indicator_id' => Indicator::factory(),
            'source_id' => Source::factory(),
            'geo_boundary_id' => GeoBoundary::factory(),
            'unit_id' => Unit::factory(),
            'gender_id' => Gender::factory(),
            'sample_size' => $this->faker->numberBetween(100, 10000),
            'source_public' => $this->faker->boolean,
            'smallholder_definition_id' => SmallholderDefinition::factory(),
            'user_id' => User::factory(),
            'purpose_of_collection_id' => PurposeOfCollection::factory(),
            'approach_collection_id' => ApproachCollection::factory(),
        ];
    }
}
