<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function allCOArr(){
        return json_encode(array(1,2,3,4,5,6));
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_oral_endsem_assign', function (Blueprint $table) {
            $table->id("co_oral_endsem_assign_id");
            $table->string("oral_co", 50)->default($this->allCOArr());
            $table->string("endsem_co", 50)->default($this->allCOArr());
            $table->string("assign1_co", 50)->default($this->allCOArr());
            $table->string("assign2_co", 50)->default($this->allCOArr());
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
        Schema::dropIfExists('co_oral_endsem_assign');
    }
};
