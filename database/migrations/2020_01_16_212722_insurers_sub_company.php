<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsurersSubCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurers_sub_company', function (Blueprint $table) {
            $table->bigIncrements('id_insurers_sub_company');
            $table->integer('id_surgerie');	
            $table->string('name', 255);
            $table->string('nit', 255);
            $table->integer('type_sub_company');	
            $table->integer('turn_check');	
            $table->string('to_name', 255);
            $table->integer('court_of_accounts');	
            $table->integer('ica');	
            $table->integer('percentage_ica');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurers_sub_company');
    }
}
