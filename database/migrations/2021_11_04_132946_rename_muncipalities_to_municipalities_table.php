<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMuncipalitiesToMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('muncipalities', 'municipalities');
        Schema::table('municipalities', function(Blueprint $table) {
            $table->renameIndex('muncipalities_name_unique', 'municipalities_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('municipalities', 'muncipalities');
    Schema::table('muncipalities', function(Blueprint $table) {
            $table->renameIndex('municipalities_name_unique', 'muncipalities_name_unique');
        });
    }
}
