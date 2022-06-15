<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_category_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_category_id');
            $table->unsignedBigInteger('type_id');
            $table->year('year')->nullable();
            $table->integer('price_seven_night')->nullable();
            $table->integer('price_monday_to_friday')->nullable();
            $table->integer('price_friday_to_monday')->nullable();
            $table->integer('price_standing_charge')->nullable();
            $table->integer('price_sunday_to_thursday')->nullable();
            $table->integer('price_friday_to_saturday')->nullable();
            $table->integer('weekend_friday_to_monday')->nullable();

            $table->timestamps();

            $table->foreign('price_category_id')->references('id')->on('price_categories');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_category_type');
    }
}
