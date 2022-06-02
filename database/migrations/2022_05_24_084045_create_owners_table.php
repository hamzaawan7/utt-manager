<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();

            $table->string('owner_name');
            $table->string('address');
            $table->string('main_contact_name');
            $table->string('main_contact_number');
            $table->string('secondary_contact_name');
            $table->string('secondary_contact_number');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
