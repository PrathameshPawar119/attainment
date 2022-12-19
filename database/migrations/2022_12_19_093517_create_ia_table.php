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
        Schema::create('ia', function (Blueprint $table) {
            $table->id('ia_id');
            $table->integer('ia1q1');
            $table->integer('ia1q2');
            $table->integer('ia1q3');
            $table->integer('ia1q4');
            $table->integer('ia1')->virtualAs('ia1q1 + ia1q2 + ia1q3 + ia1q4')->nullable();
            $table->integer('ia2q1');
            $table->integer('ia2q2');
            $table->integer('ia2q3');
            $table->integer('ia2q4');
            $table->integer('ia2')->virtualAs('ia2q1 + ia2q2 + ia2q3 + ia2q4')->nullable();
            $table->bigInteger('id')->unsigned();
            $table->foreign('id')->references('id')->on('student_details');
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
        Schema::dropIfExists('ia');
    }
};
