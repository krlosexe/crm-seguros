<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecibosCobranza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_cobranza', function (Blueprint $table) {
            $table->bigIncrements('id_recibos_cobranza');
            $table->integer('id_policie');	
            $table->integer('monthly_fee');	
            $table->date('payment_date');
            $table->enum('type_operation', ['C', 'A']);	
            $table->double('amount', 10, 2);
            $table->double('payment', 10, 2)->nullable();;
            $table->double('balance', 10, 2);
            $table->integer('status');	
        });
    }

    /**ph p
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
