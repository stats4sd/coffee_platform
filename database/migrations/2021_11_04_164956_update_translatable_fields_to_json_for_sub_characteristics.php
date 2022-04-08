<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForSubCharacteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_characteristics', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('sub_characteristics_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update sub_characteristics set sub_characteristics.name = concat(\'{ "en": "\', sub_characteristics.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('sub_characteristics', function(Blueprint $table) {
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
        Schema::table('sub_characteristics', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update sub_characteristics set sub_characteristics.name = json_unquote(sub_characteristics.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('sub_characteristics', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('sub_characteristics', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'sub_characteristics_name_unique');
        });
    }
}
