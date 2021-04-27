<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefinitionToIndicatorValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->string('definition')->nullable()->after('approach_collection_id');
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
            $table->string('definition');
        });
    }
}
