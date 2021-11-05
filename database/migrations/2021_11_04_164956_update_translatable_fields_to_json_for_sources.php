<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForSources extends Migration
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
            update sources set
                sources.name = concat(\'{ "en": "\', sources.name, \'"}\'),
                sources.reference = concat(\'{ "en": "\', sources.reference, \'"}\'),
                sources.description = concat(\'{ "en": "\', sources.description, \'"}\');
        ');

        // need seperate call / seperate transaction;
        Schema::table('sources', function(Blueprint $table) {
            $table->json('name')->change();
            $table->json('reference')->nullable()->change();
            $table->json('description')->nullable()->change();
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
        Schema::table('sources', function (Blueprint $table) {
            $table->text('name')->change();
            $table->text('reference')->nullable()->change();
            $table->text('description')->nullable()->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update sources set
                sources.name = json_unquote(sources.name->"$.en"),
                sources.reference = json_unquote(sources.reference->"$.en"),
                sources.description = json_unquote(sources.description->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('sources', function(Blueprint $table) {
            $table->string('name')->change();
            $table->string('reference')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }
}
