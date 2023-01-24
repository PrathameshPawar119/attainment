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
        Schema::create('p_o_models', function (Blueprint $table) {
            $table->id('p_o_models_id');
            $table->integer('PO1')->default(1);
            $table->integer('PO2')->default(1);
            $table->integer('PO3')->default(1);
            $table->integer('PO4')->default(1);
            $table->integer('PO5')->default(1);
            $table->integer('PO6')->default(1);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('signup_details');
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
        Schema::dropIfExists('p_o_models');
    }
};
