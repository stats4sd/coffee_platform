<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('units_unit_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update units set units.unit = concat(\'{ "en": "\', units.unit, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('units', function(Blueprint $table) {
            $table->json('unit')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // reverse the process - switch to 'text' temporarily so we can undo the transformation to JSON from plain text:
        Schema::table('units', function (Blueprint $table) {
            $table->text('unit')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update units set units.unit = json_unquote(units.unit->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('units', function(Blueprint $table) {
            $table->string('unit')->change();
        });

                Schema::table('units', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('unit', 'units_unit_unique');
        });

    }
}
