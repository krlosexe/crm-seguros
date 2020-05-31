<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fasecolda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasecolda', function (Blueprint $table) {
            $table->bigIncrements('id_fasecolda');
            $table->string('novedad', 255);
            $table->string('marca', 255);
            $table->string('clase', 255);
            $table->integer('codigo');
            $table->string('homologocodigo', 255);
            $table->string('referencia1', 255);
            $table->string('referencia2', 255);
            $table->string('referencia3', 255);
            $table->integer('peso');
            $table->integer('id_servicio');
            $table->string('servicio', 255);
            $table->integer('year_1970');
            $table->integer('year_1971');
            $table->integer('year_1972');
            $table->integer('year_1973');
            $table->integer('year_1974');
            $table->integer('year_1975');
            $table->integer('year_1976');
            $table->integer('year_1977');
            $table->integer('year_1978');
            $table->integer('year_1979');
            $table->integer('year_1980');
            $table->integer('year_1981');
            $table->integer('year_1982');
            $table->integer('year_1983');
            $table->integer('year_1984');
            $table->integer('year_1985');
            $table->integer('year_1986');
            $table->integer('year_1987');
            $table->integer('year_1988');
            $table->integer('year_1989');
            $table->integer('year_1990');
            $table->integer('year_1991');
            $table->integer('year_1992');
            $table->integer('year_1993');
            $table->integer('year_1994');
            $table->integer('year_1995');
            $table->integer('year_1996');
            $table->integer('year_1997');
            $table->integer('year_1998');
            $table->integer('year_1999');
            $table->integer('year_2000');
            $table->integer('year_2001');
            $table->integer('year_2002');
            $table->integer('year_2003');
            $table->integer('year_2004');
            $table->integer('year_2005');
            $table->integer('year_2006');
            $table->integer('year_2007');
            $table->integer('year_2008');
            $table->integer('year_2009');
            $table->integer('year_2010');
            $table->integer('year_2011');
            $table->integer('year_2012');
            $table->integer('year_2013');
            $table->integer('year_2014');
            $table->integer('year_2015');
            $table->integer('year_2016');
            $table->integer('year_2017');
            $table->integer('year_2018');
            $table->integer('year_2019');
            $table->integer('year_2020');
            $table->integer('year_2021');
            $table->integer('bcpp');
            $table->integer('importado');
            $table->integer('potencia');
            $table->string('tipo_caja', 255);
            $table->integer('cilindraje');
            $table->string('nacionalidad', 255);
            $table->integer('capacidad_pasajeros');
            $table->integer('capacidad_carga');
            $table->integer('puertas');
            $table->integer('a/i');
            $table->integer('ejes');
            $table->string('estado', 255);
            $table->string('combustible', 255);
            $table->string('transmision', 255);
            $table->integer('um');
            $table->integer('peso_categoria');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasecolda');
    }
}
