<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourcePublicToSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->tinyInteger('is_not_public')->default(0)->after('partner_id');
        });
        Schema::table('indicator_values', function (Blueprint $table) {
            $table->dropColumn('source_public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn('is_not_public');
        });

        Schema::table('indicator_values', function (Blueprint $table) {
            $table->tinyInteger('source_public');
        });
    }
}
