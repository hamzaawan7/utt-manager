<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNearbyPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nearby_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('property_id')->nullable();
            $table->unsignedInteger('nearby_property_id')->nullable();

            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('nearby_property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nearby_properties');
    }
}
