<?php

namespace App\Http\Controllers;

use App\Fasecolda;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FasecoldaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function Import(){
        $fila = 1;
        if (($gestor = fopen("fasecolda.csv", "r")) !== FALSE) {

            $insert_todos = "";

            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $numero = count($datos);
               // echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                $fila++;

                if ($insert_todos != "") {
                    $insert_todos .= ", ";
                }



                $insert_todos .= '("'.$datos[0].'", "'.$datos[1].'", "'.$datos[2].'", "'.$datos[3].'", "'.$datos[4].'", "'.$datos[5].'", "'.$datos[6].'", "'.$datos[7].'", "'.$datos[8].'", "'.$datos[9].'", "'.$datos[10].'", "'.$datos[1].'", "'.$datos[12].'", "'.$datos[13].'", "'.$datos[14].'", "'.$datos[15].'", "'.$datos[16].'", "'.$datos[17].'", "'.$datos[18].'", "'.$datos[19].'", "'.$datos[20].'", "'.$datos[21].'", "'.$datos[22].'", "'.$datos[23].'", "'.$datos[24].'", "'.$datos[25].'", "'.$datos[26].'", "'.$datos[27].'", "'.$datos[28].'", "'.$datos[29].'", "'.$datos[30].'", "'.$datos[31].'", "'.$datos[32].'", "'.$datos[33].'", "'.$datos[34].'", "'.$datos[35].'", "'.$datos[36].'", "'.$datos[37].'", "'.$datos[38].'", "'.$datos[39].'", "'.$datos[40].'", "'.$datos[41].'", "'.$datos[42].'", "'.$datos[43].'", "'.$datos[44].'", "'.$datos[45].'", "'.$datos[46].'", "'.$datos[47].'", "'.$datos[48].'", "'.$datos[49].'", "'.$datos[50].'", "'.$datos[51].'", "'.$datos[52].'", "'.$datos[53].'", "'.$datos[54].'", "'.$datos[55].'", "'.$datos[56].'", "'.$datos[57].'", "'.$datos[58].'", "'.$datos[59].'", "'.$datos[60].'", "'.$datos[61].'", "'.$datos[62].'", "'.$datos[63].'", "'.$datos[64].'", "'.$datos[65].'", "'.$datos[66].'", "'.$datos[67].'", "'.$datos[68].'", "'.$datos[69].'", "'.$datos[70].'", "'.$datos[71].'", "'.$datos[72].'", "'.$datos[73].'", "'.$datos[74].'", "'.$datos[75].'", "'.$datos[76].'", "'.$datos[77].'", "'.$datos[78].'")';

      
                break;
            }



         $result = DB::insert(

                DB::raw("
                INSERT INTO fasecolda (`novedad`, `marca`, `clase`, `codigo`, `homologocodigo`, `referencia1`, `referencia2`, `referencia3`, `peso`, `id_servicio`, `servicio`, `1970`, `1971`, `1972`, `1973`, `1974`, `1975`, `1976`, `1977`, `1978`, `1979`, `1980`, `1981`, `1982`, `1983`, `1984`, `1985`, `1986`, `1987`, `1988`, `1989`, `1990`, `1991`, `1992`, `1993`, `1994`, `1995`, `1996`, `1997`, `1998`, `1999`, `2000`, `2001`, `2002`, `2003`, `2004`, `2005`, `2006`, `2007`, `2008`, `2009`, `2010`, `2011`, `2012`, `2013`, `2014`, `2015`, `2016`, `2017`, `2018`, `2019`, `2020`, `2021`, `bcpp`, `importado`, `potencia`, `tipo_caja`, `cilindraje`, `nacionalidad`, `capacidad_pasajeros`, `capacidad_carga`, `puertas`, `a/i`, `ejes`, `estado`, `combustible`, `transmision`, `um`, `peso_categoria`)
                    VALUES ".$insert_todos."
                                        
                "
                                    
                )
            );  
                

               // echo json_encode($insert_todos);


        }

    }



    public function typeVehicule(){
       
        
        $data = Fasecolda::select("clase")
                        ->groupBy("clase")
                        ->get();
        return response()->json($data)->setStatusCode(200);
    }


    public function typeVehiculeTrademark(Request $request){

        $data = Fasecolda::select("marca")
                        ->where("clase", $request["clase"])
                        ->groupBy("marca")
                        ->get();


        return response()->json($data)->setStatusCode(200);
    }



    public function typeVehiculeTrademarkLine(Request $request){

        $data = Fasecolda::select("referencia1")
                        ->where("marca", $request["marca"])
                        ->groupBy("referencia1")
                        ->get();


        return response()->json($data)->setStatusCode(200);
    }



    public function typeVehiculeTrademarkRefer2(Request $request){

        $data = Fasecolda::select("referencia2")
                        ->where("referencia1", $request["linea"])
                        ->groupBy("referencia2")
                        ->get();


        return response()->json($data)->setStatusCode(200);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fasecolda  $fasecolda
     * @return \Illuminate\Http\Response
     */
    public function show(Fasecolda $fasecolda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fasecolda  $fasecolda
     * @return \Illuminate\Http\Response
     */
    public function edit(Fasecolda $fasecolda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fasecolda  $fasecolda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fasecolda $fasecolda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fasecolda  $fasecolda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasecolda $fasecolda)
    {
        //
    }
}
