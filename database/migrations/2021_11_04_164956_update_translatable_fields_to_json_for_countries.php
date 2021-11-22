<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('countries_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update countries set countries.name = concat(\'{ "en": "\', countries.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('countries', function(Blueprint $table) {
            $table->json('name')->change();
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
        Schema::table('countries', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update countries set countries.name = json_unquote(countries.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('countries', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('countries', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'countries_name_unique');
        });
    }
}
