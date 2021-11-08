<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateStandardUnitsToIdInUnitTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // swap to use ID
        DB::unprepared('
            update unit_types
                left join units on json_unquote(units.unit->"$.en") = unit_types.standard_unit

                set unit_types.standard_unit = units.id;
        ');

        Schema::table('unit_types', function (Blueprint $table) {
            $table->unsignedBigInteger('standard_unit')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // swap to use name from ID
        DB::unprepared('
            update unit_types
                left join units on units.id = unit_types.standard_unit

                set unit_types.standard_unit =  json_unquote(units.unit->"$.en");
        ');
        Schema::table('unit_types', function (Blueprint $table) {
            $table->unsignedBigInteger('standard_unit')->change();
        });
    }
}
