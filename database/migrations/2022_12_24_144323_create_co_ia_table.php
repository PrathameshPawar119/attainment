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
        Schema::create('co_ia', function (Blueprint $table) {
            $table->id('co_ia_id');
            $table->string("CO1", 50)->nullable();
            $table->string("CO2", 50)->nullable();
            $table->string("CO3", 50)->nullable();
            $table->string("CO4", 50)->nullable();
            $table->string("CO5", 50)->nullable();
            $table->string("CO6", 50)->nullable();
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("user_id")->on("signup_details");
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
        Schema::dropIfExists('co_ia');
    }
};
