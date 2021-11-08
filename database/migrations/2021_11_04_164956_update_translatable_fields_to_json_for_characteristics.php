<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForCharacteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characteristics', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('characteristics_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update characteristics set characteristics.name = concat(\'{ "en": "\', characteristics.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('characteristics', function(Blueprint $table) {
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
        Schema::table('characteristics', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update characteristics set characteristics.name = json_unquote(characteristics.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('characteristics', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('characteristics', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'characteristics_name_unique');
        });
    }
}
