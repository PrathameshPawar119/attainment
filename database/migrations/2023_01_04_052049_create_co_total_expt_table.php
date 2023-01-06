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
        Schema::create('co_total_expt', function (Blueprint $table) {
            $table->id('co_total_expt_id');
            $table->integer('CO1')->default(0);
            $table->integer('CO2')->default(0);
            $table->integer('CO3')->default(0);
            $table->integer('CO4')->default(0);
            $table->integer('CO5')->default(0);
            $table->integer('CO6')->default(0);
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
        Schema::dropIfExists('co_total_expt');
    }
};
