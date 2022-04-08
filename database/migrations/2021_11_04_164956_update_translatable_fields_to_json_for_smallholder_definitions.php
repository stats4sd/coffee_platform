<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForSmallholderDefinitions extends Migration
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
            update smallholder_definitions set smallholder_definitions.definition = concat(\'{ "en": "\', smallholder_definitions.definition, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('smallholder_definitions', function(Blueprint $table) {
            $table->json('definition')->change();
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
        Schema::table('smallholder_definitions', function (Blueprint $table) {
            $table->text('definition')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update smallholder_definitions set smallholder_definitions.definition = json_unquote(smallholder_definitions.definition->"$.en");
        ');


    }
}
