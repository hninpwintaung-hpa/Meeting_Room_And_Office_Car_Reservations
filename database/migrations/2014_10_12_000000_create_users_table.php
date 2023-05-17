<?php
<<<<<<< HEAD
=======

>>>>>>> hpa
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
<<<<<<< HEAD
            $table->string('employee_id')->unique();
            $table->string('phone')->unique();
=======
>>>>>>> hpa
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status');
            $table->foreignId('team_id');
<<<<<<< HEAD
            // $table->unsignedBigInteger('team_id');
            // $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
=======
>>>>>>> hpa
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
