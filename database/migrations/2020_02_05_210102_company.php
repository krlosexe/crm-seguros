<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_company', function (Blueprint $table) {
            $table->bigIncrements('id_my_company');
            $table->string('logo', 500);
            $table->string('name', 500);
            $table->string('nit', 500);
            $table->string('phone', 500);
            $table->string('email', 500);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_company');
    }
}
