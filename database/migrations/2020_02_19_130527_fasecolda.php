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
            $table->integer('1970');
            $table->integer('1971');
            $table->integer('1972');
            $table->integer('1973');
            $table->integer('1974');
            $table->integer('1975');
            $table->integer('1976');
            $table->integer('1977');
            $table->integer('1978');
            $table->integer('1979');
            $table->integer('1980');
            $table->integer('1981');
            $table->integer('1982');
            $table->integer('1983');
            $table->integer('1984');
            $table->integer('1985');
            $table->integer('1986');
            $table->integer('1987');
            $table->integer('1988');
            $table->integer('1989');
            $table->integer('1990');
            $table->integer('1991');
            $table->integer('1992');
            $table->integer('1993');
            $table->integer('1994');
            $table->integer('1995');
            $table->integer('1996');
            $table->integer('1997');
            $table->integer('1998');
            $table->integer('1999');
            $table->integer('2000');
            $table->integer('2001');
            $table->integer('2002');
            $table->integer('2003');
            $table->integer('2004');
            $table->integer('2005');
            $table->integer('2006');
            $table->integer('2007');
            $table->integer('2008');
            $table->integer('2009');
            $table->integer('2010');
            $table->integer('2011');
            $table->integer('2012');
            $table->integer('2013');
            $table->integer('2014');
            $table->integer('2015');
            $table->integer('2016');
            $table->integer('2017');
            $table->integer('2018');
            $table->integer('2019');
            $table->integer('2020');
            $table->integer('2021');
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
