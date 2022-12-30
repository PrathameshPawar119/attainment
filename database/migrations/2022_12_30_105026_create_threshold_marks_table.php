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
        Schema::create('threshold_marks', function (Blueprint $table) {
            $table->id('threshold_marks_id');
            $table->integer('oral');
            $table->integer('endsem');
            $table->integer('assigns');
            $table->integer('ia');
            $table->integer('expt');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on("signup_details");
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
        Schema::dropIfExists('threshold_marks');
    }
};
