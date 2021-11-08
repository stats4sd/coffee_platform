<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForIndicators extends Migration
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
            update indicators set indicators.name = concat(\'{ "en": "\', indicators.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('indicators', function(Blueprint $table) {
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
        Schema::table('indicators', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update indicators set indicators.name = json_unquote(indicators.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('indicators', function(Blueprint $table) {
            $table->string('name')->change();
        });

    }
}
