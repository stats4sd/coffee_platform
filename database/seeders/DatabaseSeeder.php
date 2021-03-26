<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Gender;
use App\Models\Source;
use App\Models\Country;
use App\Models\Partner;
use App\Models\Indicator;
use App\Models\GeoBoundary;
use App\Models\Characteristic;
use App\Models\IndicatorValue;
use Illuminate\Database\Seeder;
use App\Models\SubCharacteristic;
use App\Models\ApproachCollection;
use App\Models\PurposeOfCollection;
use App\Models\SmallholderDefinition;
use App\Models\UnitType;
use App\Models\Year;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') === 'local') {
            User::factory(['name' => 'test', 'email' => 'test@example.com'])->create(); // factory sets default password to 'password'
        }

        $years = Year::factory()->count(11)->state(new Sequence(
            ['year' => '2010'],
            ['year' => '2011'],
            ['year' => '2012'],
            ['year' => '2013'],
            ['year' => '2014'],
            ['year' => '2015'],
            ['year' => '2016'],
            ['year' => '2017'],
            ['year' => '2018'],
            ['year' => '2019'],
            ['year' => '2020'],
            ['year' => '2021'],
        ))->create();

        Characteristic::factory()->count(5)
        ->has(
            SubCharacteristic::factory()->count(3)
            ->has(Indicator::factory()->count(4))
        )
        ->create();


        $users = User::factory()->count(5)->create();
        $unitTypes = UnitType::factory()->count(3)->has(
            Unit::factory()->count(3)
        )->create();

        $gender = Gender::factory()->count(5)->create();
        $smallholderDefinitions = SmallholderDefinition::factory()->count(5)->create();
        $purposeOfCollections = PurposeOfCollection::factory()->count(5)->create();
        $approachCollections = ApproachCollection::factory()->count(5)->create();
        $countries = Country::factory()->count(5)->has(GeoBoundary::factory()->count(3))->create();

        $partners = Partner::factory()->count(3)->create();
        $types = Type::factory()->count(3)->create();

        // create 10 sources linked to random partners and types
        $sources = Source::factory()->count(10)
        ->for($partners->random())
        ->for($types->random())
        ->create();


        $units = Unit::all();

        // Using for loop to ensure each value is assigned a different random relationship
        for ($i=0; $i < 500; $i++) {
            $numberOfYears = collect([1,2])->random();
            $selectedYears = $years->random($numberOfYears);

            $indicatorValue = IndicatorValue::factory()
            ->for($users->random())
            ->for($units->random())
            ->for($gender->random())
            ->for($approachCollections->random())
            ->for($smallholderDefinitions->random())
            ->for($purposeOfCollections->random())
            ->for(GeoBoundary::all()->random())
            ->for(Indicator::all()->random())
            ->for($sources->random())
            ->create();

            $indicatorValue->years()->sync($selectedYears);
        }
    }
}
