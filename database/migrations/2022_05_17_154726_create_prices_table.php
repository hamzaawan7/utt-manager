<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('property_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('season_id')->nullable();
            $table->string('range');
            $table->string('price');

            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('category_id')->references('id')->on('price_categories');
            $table->foreign('season_id')->references('id')->on('price_seasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
