<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveTypeFromSourcesToParteners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('name')->nullable();
          
        });

        Schema::table('partners', function(Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
        Schema::table('sources', function (Blueprint $table) {
            $table->dropForeign('sources_type_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            //
        });
    }
}
