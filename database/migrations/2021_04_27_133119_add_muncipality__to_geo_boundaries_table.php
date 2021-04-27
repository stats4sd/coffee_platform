<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMuncipalityToGeoBoundariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('geo_boundaries', function (Blueprint $table) {
            $table->unsignedBigInteger('muncipality_id')->nullable()->after('department_id');
        });
        Schema::table('geo_boundaries', function(Blueprint $table) {
            $table->foreign('muncipality_id')->references('id')->on('muncipalities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('geo_boundaries', function (Blueprint $table) {
            //
        });
    }
}
