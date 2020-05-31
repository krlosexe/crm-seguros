<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsuerersOficce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurers_oficce', function (Blueprint $table) {
            $table->bigIncrements('id_insurers_oficce');
            $table->integer('id_surgerie');	
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('fax', 255);
            $table->integer('headquarters_default');	
            $table->string('name_contact', 255);
            $table->string('phone_contact', 255);
            $table->string('email_contact', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurers_oficce');
    }
}
