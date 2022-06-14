<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->year('year')->nullable();
            $table->integer('price_seven_night')->nullable();
            $table->integer('price_monday_to_friday')->nullable();
            $table->integer('price_friday_to_monday')->nullable();
            $table->integer('price_standing_charge')->nullable();
            $table->integer('price_sunday_to_thursday')->nullable();
            $table->integer('price_friday_to_saturday')->nullable();
            $table->integer('price_seven_nights')->nullable();
            $table->integer('weekend_friday_to_monday')->nullable();

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
        Schema::dropIfExists('types');
    }
}
