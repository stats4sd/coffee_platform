<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->unsignedBigInteger('smallholder_definition_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->unsignedBigInteger('smallholder_definition_id')->change();
        });
    }
};
