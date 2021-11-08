<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->dropUnique('departments_name_unique');
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update departments set departments.name = concat(\'{ "en": "\', departments.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('departments', function(Blueprint $table) {
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
        Schema::table('departments', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update departments set departments.name = json_unquote(departments.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('departments', function(Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('departments', function (Blueprint $table) {
            // remove index as unique indexing cannot occur on a json object
            $table->unique('name', 'departments_name_unique');
        });
    }
}
