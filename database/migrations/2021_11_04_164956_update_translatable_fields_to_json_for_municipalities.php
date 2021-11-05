<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForMunicipalities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('municipalities', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('municipalities_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update municipalities set municipalities.name = concat(\'{ "en": "\', municipalities.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('municipalities', function(Blueprint $table) {
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
        Schema::table('municipalities', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update municipalities set municipalities.name = json_unquote(municipalities.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('municipalities', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('municipalities', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'municipalities_name_unique');
        });
    }
}
