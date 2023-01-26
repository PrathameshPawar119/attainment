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
        Schema::create('final_attainments', function (Blueprint $table) {
            $table->id('final_attainments_id');
            $table->string('oral', 150)->default(json_encode(array(0,0,0,0,0,0)));
            $table->string('endsem', 150)->default(json_encode(array(0,0,0,0,0,0)));
            $table->string('assignments', 150)->default(json_encode(array(0,0,0,0,0,0)));
            $table->string('ia', 150)->default(json_encode(array(0,0,0,0,0,0)));
            $table->string('experiments', 150)->default(json_encode(array(0,0,0,0,0,0)));
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
        Schema::dropIfExists('final_attainments');
    }
};
