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
        Schema::create('experiments', function (Blueprint $table) {
            $table->id('experiments_id');
            for ($i=1; $i <= 12; $i++) { 
                $table->integer('e'.$i.'r1');
                $table->integer('e'.$i.'r2');
                $table->integer('e'.$i.'r3');
                $table->integer('e'.$i)->virtualAs('e'.$i.'r1 + e'.$i.'r2 + e'.$i.'r3')->nullable();
            }
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
        Schema::dropIfExists('experiments');
    }
};
