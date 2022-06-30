<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class LibertyController extends Controller
{
    public function PdfPlan($id_cotizacion, $plan){

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<h1>Styde.net</h1>');

        $cotizacion = DB::table("vehiculo_cotizador")->where("id_vehiculo", $id_cotizacion)->first();
       
        $data["datos_personales"] = $cotizacion;
        
        
        

        //dd($data["datos_personales"]);
        $data["cotizacion"]       = json_decode(json_decode($cotizacion->cotizacion_json)->$plan);

       // $data["datos_personales"]->fasecolda = json_decode(json_decode($cotizacion->cotizacion_json)->planes)[0]->infoVehiculo->fasecolda;
       $data["datos_personales"]->fasecolda = "01601203";

        //$data["cazador"] = $data["cotizacion"]->preguntaPoliza[0]->respuesta->codigo;
        $data["cazador"] = 0;
        
        return $pdf->loadView('liberty.plan', $data)
            ->stream('archivo.pdf');
    }
}
