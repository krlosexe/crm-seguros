<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChargeAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_accounts', function (Blueprint $table) {
            $table->bigIncrements('id_charge_accounts');
            $table->enum('policie_annexes', ['Poliza', 'Anexo']);	
            $table->integer('number');	
            $table->date('init_date');	
            $table->date('limit_date');	
            $table->string('issue', 500);
            $table->double('cousin', 10, 2);
            $table->double('xpenses', 10, 2);
            $table->double('vat', 10, 2);
            $table->integer('percentage_vat_cousin');	
            $table->integer('commission_percentage');	
            $table->double('agency_commission', 10, 2);
            $table->double('total', 10, 2);
            $table->string('observations', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_accounts');
    }
}
