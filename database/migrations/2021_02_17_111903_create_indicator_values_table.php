<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('indicator_id')->constrained()->onDelete('cascade');
            $table->decimal('value')->nullable();
            $table->foreignId('source_id')->constrained()->onDelete('cascade')->nullable();
            $table->tinyInteger('source_public');
            $table->year('year')->nullable();
            $table->foreignId('geo_boundary_id')->constrained('geo_boundaries')->onDelete('cascade')->nullable();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('gender_id')->constrained()->onDelete('cascade')->nullable();
            $table->integer('sample_size')->nullable();
            $table->foreignId('smallholder_definition_id')->constrained('smallholder_definitions')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('purpose_of_collection_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('approach_collection_id')->constrained()->onDelete('cascade')->nullable();
            $table->text('scope')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_values');
    }
}
