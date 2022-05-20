<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('property_id')->nullable();
            $table->string('number');
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->integer('number_of_guest');
            $table->integer('number_of_night');
            $table->string('status');
            $table->integer('number_of_adults');
            $table->integer('number_of_children');
            $table->integer('number_of_pets');
            $table->integer('number_of_infants');
            $table->string('note');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('property_id')->references('id')->on('properties');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
}
