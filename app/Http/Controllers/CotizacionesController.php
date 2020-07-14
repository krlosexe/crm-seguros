<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CotizacionesController extends Controller
{

    function index(){

        $result = DB::table('vehiculo_cotizador')->where('status', 1)->get();

        foreach ($result as $key => $value) {
            $value->nombre_completo = $value->nombre.' '.$value->apellido;
            $value->estado = $value->estatus;
            $value->fecha_consulta = date('d/m/Y H:i:s', strtotime($value->created_at));
        }

        return response()->json($result)->setStatusCode(200);;  
    }

    function update(Request $request){

        DB::table('vehiculo_cotizador')->where('id_vehiculo', $request->id_user_edit)->update(['estatus' => $request->estado]);

        $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
        return response()->json($data)->setStatusCode(200);
    }



    public function status($id, $status, Request $request){

            DB::table('vehiculo_cotizador')->where('id_vehiculo', $id)->update(['status' => $status]);

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente"); 

            return response()->json($data)->setStatusCode(200);

    }

}
