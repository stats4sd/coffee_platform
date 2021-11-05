<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForApproachCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('approach_collections', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('approach_collections_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update approach_collections set approach_collections.name = concat(\'{ "en": "\', approach_collections.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('approach_collections', function(Blueprint $table) {
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
        Schema::table('approach_collections', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update approach_collections set approach_collections.name = json_unquote(approach_collections.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('approach_collections', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('approach_collections', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'approach_collections_name_unique');
        });
    }
}
