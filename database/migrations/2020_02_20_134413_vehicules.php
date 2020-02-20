<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vehicules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id_vehicules');
            $table->string('placa', 255);
            $table->integer('model');
            $table->string('color', 255);
            $table->string('number_motor', 255);
            $table->string('number_chassis', 255);
            $table->string('due_date_techno_mechanics', 255);
            $table->double('value_fasecolda', 10,2);
            $table->integer('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
