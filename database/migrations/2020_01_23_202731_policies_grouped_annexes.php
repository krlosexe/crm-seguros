<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PoliciesGroupedAnnexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies_grouped_annexes', function (Blueprint $table) {
            $table->bigIncrements('id_policies_grouped_annexes');
            $table->integer('id_policies');	
            $table->integer('number_annexed');	
            $table->enum('state', ['Vigente']);	
            $table->string('risk', 255);
            $table->integer('is_renewable');	
            $table->string('reason', 255);
            $table->date('expedition_date');	
            $table->date('start_date');	
            $table->date('end_date');	
            $table->date('reception_date');	
            $table->double('cousin', 10, 2);
            $table->double('xpenses', 10, 2);
            $table->double('vat', 10, 2);
            $table->integer('percentage_vat_cousin');	
            $table->integer('commission_percentage');	
            $table->double('agency_commission', 10, 2);
            $table->double('total', 10, 2);
            $table->enum('payment_method', ['Contado', 'Financiado']);	
            $table->string('observations', 500);
            $table->string('accessories', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies_grouped_annexes');
    }
}
