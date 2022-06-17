<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->integer('is_active');
            $table->string('reference_code');
            $table->string('code_type');
            $table->integer('value');
            $table->integer('all_property');
            $table->timestamp('holiday_must_start_after')->nullable();
            $table->timestamp('holiday_must_start_by')->nullable();
            $table->string('email');
            $table->string('reason');

            $table->timestamps();

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
        Schema::dropIfExists('discounts');
    }
}
