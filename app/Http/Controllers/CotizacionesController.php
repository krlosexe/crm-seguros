<?php

namespace App\Http\Controllers;
use DB;

class CotizacionesController extends Controller
{

    function index(){

        $result = DB::table('vehiculo_cotizador')->get();

        foreach ($result as $key => $value) {
            $value->nombre_completo = $value->nombre.' '.$value->apellido;
            $value->estado = $value->estatus;
            $value->status = 1;
            $value->fecha_consulta = date('d/m/Y H:i:s', strtotime($value->created_at));
        }

        return response()->json($result)->setStatusCode(200);;  
    }

}
