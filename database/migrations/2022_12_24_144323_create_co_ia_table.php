<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function NullCoArr(){
        return json_encode(array());
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_ia', function (Blueprint $table) {
            $table->id('co_ia_id');
            $table->string("CO1", 100)->default($this->NullCoArr());
            $table->string("CO2", 100)->default($this->NullCoArr());
            $table->string("CO3", 100)->default($this->NullCoArr());
            $table->string("CO4", 100)->default($this->NullCoArr());
            $table->string("CO5", 100)->default($this->NullCoArr());
            $table->string("CO6", 100)->default($this->NullCoArr());
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
