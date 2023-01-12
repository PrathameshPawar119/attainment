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
        Schema::create('criteria', function (Blueprint $table) {
            $table->id('criteria_id');
            $table->integer('oral_total')->default(0);
            $table->integer('endsem_total')->default(0);
            $table->integer('assign_p1')->default(0);
            $table->integer('assign_p2')->default(0);
            $table->integer('assign_p3')->default(0);
            $table->integer('assign_total')->virtualAs('assign_p1 + assign_p2 + assign_p3')->nullable();
            $table->integer('ia1_q1')->default(0);
            $table->integer('ia1_q2')->default(0);
            $table->integer('ia1_q3')->default(0);
            $table->integer('ia1_q4')->default(0);
            $table->integer('ia1_total')->virtualAs('ia1_q1 + ia1_q2 + ia1_q3 + ia1_q4')->nullable();
            $table->integer('ia2_q1')->default(0);
            $table->integer('ia2_q2')->default(0);
            $table->integer('ia2_q3')->default(0);
            $table->integer('ia2_q4')->default(0);
            $table->integer('ia2_total')->virtualAs('ia2_q1 + ia2_q2 + ia2_q3 + ia2_q4')->nullable();
            $table->integer('exp_r1')->default(0);
            $table->integer('exp_r2')->default(0);
            $table->integer('exp_r3')->default(0);
            $table->integer('exp_total')->virtualAs('exp_r1 + exp_r2 + exp_r3')->nullable();
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
        Schema::dropIfExists('criteria');
    }
};
