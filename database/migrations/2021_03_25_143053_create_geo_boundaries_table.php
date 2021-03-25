<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoBoundariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_boundaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->text('description');
            $table->integer('altitude');
            $table->timestamps();
        });
        Schema::table('geo_boundaries', function(Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_boundaries');
    }
}
