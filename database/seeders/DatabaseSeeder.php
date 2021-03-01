<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\Indicator;
use App\Models\SubCharacteristic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Characteristic::factory()->count(3)
        ->has(
            SubCharacteristic::factory()->count(3)
            ->has(Indicator::factory()->count(4))
        )
        ->create();
    }
}
