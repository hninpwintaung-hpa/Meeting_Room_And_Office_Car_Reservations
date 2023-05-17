<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_reservation', function (Blueprint $table) {

            $table->id();
            $table->date('date');
            $table->string('title');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('destination');
            $table->integer('no_of_traveller')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->string('remark')->nullable();
            $table->string('approved_by')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();

            // // Define foreign key constraints
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_reservations');
    }
};