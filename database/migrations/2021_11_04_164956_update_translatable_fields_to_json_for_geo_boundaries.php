<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForGeoBoundaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update geo_boundaries set geo_boundaries.description = concat(\'{ "en": "\', geo_boundaries.description, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('geo_boundaries', function(Blueprint $table) {
            $table->json('description')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update geo_boundaries set geo_boundaries.altitude = concat(\'{ "en": "\', geo_boundaries.altitude, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('geo_boundaries', function(Blueprint $table) {
            $table->json('altitude')->change();
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
        Schema::table('geo_boundaries', function (Blueprint $table) {
            $table->text('description')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update geo_boundaries set geo_boundaries.descroption = json_unquote(geo_boundaries.descroption->"$.en");
        ');


        // need seperate call / seperate transaction;
        Schema::table('geo_boundaries', function(Blueprint $table) {
            $table->string('altitude')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update geo_boundaries set geo_boundaries.altitude = json_unquote(geo_boundaries.altitude->"$.en");
        ');


    }
}
