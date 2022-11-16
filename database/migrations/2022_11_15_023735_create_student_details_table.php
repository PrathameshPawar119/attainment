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
        Schema::create('student_details', function (Blueprint $table) {
            $table->id('id');
            $table->integer('roll_no');
            $table->string('student_id', 20);
            $table->string('name', 60);
            $table->enum('div', ["A", "B"]);
            $table->enum("gender", ["M" ,"F"]);
            $table->bigInteger("user_key")->unsigned();
            $table->foreign("user_key")->references('user_id')->on('signup_details');
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
        Schema::dropIfExists('student_details');
    }
};
