<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTranslatableFieldsToJsonForScopes extends Migration
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
            update scopes set scopes.name = concat(\'{ "en": "\', scopes.name, \'"}\')
        ');

        // need seperate call / seperate transaction;
        Schema::table('scopes', function(Blueprint $table) {
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
        Schema::table('scopes', function (Blueprint $table) {
            $table->text('name')->change();
        });

        //update existing values
        \Illuminate\Support\Facades\DB::unprepared('
            update scopes set scopes.name = json_unquote(scopes.name->"$.en");
        ');

        // need seperate call / seperate transaction;
        Schema::table('scopes', function(Blueprint $table) {
            $table->string('name')->change();
        });

    }
}
