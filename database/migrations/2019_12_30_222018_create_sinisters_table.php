<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinisters', function (Blueprint $table) {
            $table->bigIncrements('id_sinister');
            $table->enum('state_policie', ['Objected to', 'paid', 'in process', 'Requested']);	
            $table->string('number_sinister', 255);
            $table->string('type_sinister', 255);
            $table->date('date_sinister');
            $table->date('date_notice');
            $table->date('date_notification_insurers');
            $table->string('assigned_provider', 255);
            $table->string('descriptions', 255);
            $table->integer('policie');	
            $table->string('compensation_value', 255);
            $table->string('deductible', 255);
            $table->string('claim_amount', 255);
            $table->string('coinsurance', 255);
            $table->boolean('finalized');	
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
        Schema::dropIfExists('sinisters');
    }
}
