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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id('assignments_id');
            $table->integer('a1p1');
            $table->integer('a1p2');
            $table->integer('a1p3');
            $table->integer('a1')->virtualAs('a1p1 + a1p2 + a1p3')->nullable();
            $table->integer('a2p1');
            $table->integer('a2p2');
            $table->integer('a2p3');
            $table->integer('a2')->virtualAs('a2p1 + a2p2 + a2p3')->nullable();
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
        Schema::dropIfExists('assignments');
    }
};
