<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmparosAffected extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinister_amparos_affected', function (Blueprint $table) {
            $table->bigIncrements('id_amparos_affected');
            $table->integer('id_sinister');	
            $table->string('name_claimant', 255);
            $table->string('amparo', 255);
            $table->double('value', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amparos_affected');
    }
}
