<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIndicatorValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->unsignedBigInteger('scope_id')->after('approach_collection_id')->nullable();
            $table->unsignedBigInteger('group_id')->after('scope_id')->nullable();
            $table->tinyInteger('calculated_by_us')->default(1)->after('group_id');
        });
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->foreign('scope_id')->references('id')->on('scopes')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
            $table->dropForeign('indicator_values_scope_id_foreign');
            $table->dropForeign('indicator_values_group_id_foreign');
            $table->dropColumn('scope_id');
            $table->dropColumn('group_id');
            $table->dropColumn('calculated_by_us');
        });
    }
}
