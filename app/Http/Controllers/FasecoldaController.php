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

      
                //break;
            }



         $result = DB::insert(

                DB::raw("
                INSERT INTO fasecolda (`novedad`, `marca`, `clase`, `codigo`, `homologocodigo`, `referencia1`, `referencia2`, `referencia3`, `peso`, `id_servicio`, `servicio`, `year_1970`, `year_1971`, `year_1972`, `year_1973`, `year_1974`, `year_1975`, `year_1976`, `year_1977`, `year_1978`, `year_1979`, `year_1980`, `year_1981`, `year_1982`, `year_1983`, `year_1984`, `year_1985`, `year_1986`, `year_1987`, `year_1988`, `year_1989`, `year_1990`, `year_1991`, `year_1992`, `year_1993`, `year_1994`, `year_1995`, `year_1996`, `year_1997`, `year_1998`, `year_1999`, `year_2000`, `year_2001`, `year_2002`, `year_2003`, `year_2004`, `year_2005`, `year_2006`, `year_2007`, `year_2008`, `year_2009`, `year_2010`, `year_2011`, `year_2012`, `year_2013`, `year_2014`, `year_2015`, `year_2016`, `year_2017`, `year_2018`, `year_2019`, `year_2020`, `year_2021`, `bcpp`, `importado`, `potencia`, `tipo_caja`, `cilindraje`, `nacionalidad`, `capacidad_pasajeros`, `capacidad_carga`, `puertas`, `a/i`, `ejes`, `estado`, `combustible`, `transmision`, `um`, `peso_categoria`)
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
                        ->where("referencia1", $request["line"])
                        ->groupBy("referencia2")
                        ->get();


        return response()->json($data)->setStatusCode(200);
    }








    public function typeVehiculeTrademarkRefer2Refer3(Request $request){

        $data = Fasecolda::select("referencia3")
                        ->where("referencia2", $request["refer2"])
                        ->groupBy("referencia3")
                        
                        ->get();


        return response()->json($data)->setStatusCode(200);
    }



    public function getByClaseMarcaRefer1Refer2Refer3(Request $request){

        $data = Fasecolda::select("fasecolda.*")
                            ->where("clase", $request["clase"])
                            ->where("marca", $request["marca"])
                            ->where("referencia1", $request["refer1"])
                            ->where("referencia2", $request["refer2"])
                            ->where("referencia3", $request["refer3"])
        
                            ->first();

        return response()->json($data)->setStatusCode(200);


    }


    public function value(Request $request){

        $data = Fasecolda::select("fasecolda.year_".$request["year"]."")
                            ->where("clase", $request["clase"])
                            ->where("marca", $request["marca"])
                            ->where("referencia1", $request["refer1"])
                            ->where("referencia2", $request["refer2"])
                            ->where("referencia3", $request["refer3"])
        
                            ->first();

        return response()->json($data["year_".$request["year"].""] * 1000)->setStatusCode(200);


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
