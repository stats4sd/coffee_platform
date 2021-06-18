<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConversionRatesWithMoreDecimals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->decimal('to_standard', 20, 15)->nullable()->change();
            $table->decimal('to_standard', 20, 15)->nullable()->change();
        });

        Schema::table('_link_unit_year', function (Blueprint $table) {
            $table->decimal('to_standard', 20, 15)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->decimal('to_standard')->nullable()->change();
            $table->decimal('to_standard')->nullable()->change();
        });

        Schema::table('_link_unit_year', function (Blueprint $table) {
            $table->decimal('to_standard')->change();
        });
    }
}
