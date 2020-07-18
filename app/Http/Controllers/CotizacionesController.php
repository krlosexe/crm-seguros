<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\VehiculoCotizador;

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


      public function paginate(Request $request)
      {

            ini_set('memory_limit', '-1'); 
            
            $searchValue = $request->search['value']; // value
            $start       = $request->start;
            $length      = $request->length;
            $draw        = $request->draw;


            // $query = DB::table('vehiculo_cotizador')->where('status', 1);
            $query = VehiculoCotizador::where('status', 1);

                // se cuentan todos

                $dbTemp = Clone $query;
                $recordsTotal = $dbTemp->get()->count();
                // se aplica el filtro y se cuentan los registros filtrados

                $query->search($searchValue);

                $dbFiltered = Clone $query;
                $recordsFiltered = $dbFiltered->get()->count();

                $data = $query->paginar($start, $length)->get();

                foreach ($data as $key => $value) {
                    $value->nombre_completo = $value->nombre.' '.$value->apellido;
                    $value->estado = $value->estatus;
                    $value->fecha_consulta = date('d/m/Y H:i:s', strtotime($value->created_at));
                }

            return response()->json([
                "draw"            => intval($draw),
                "recordsTotal"    => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data"            => $data
            ])->setStatusCode(200);
        }

    function update(Request $request, $id){

        DB::table('vehiculo_cotizador')->where('id_vehiculo', $id)->update(['estatus' => $request->estado]);

        $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
        return response()->json($data)->setStatusCode(200);
    }



    public function status($id, $status, Request $request){

            DB::table('vehiculo_cotizador')->where('id_vehiculo', $id)->update(['status' => $status]);

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente"); 

            return response()->json($data)->setStatusCode(200);

    }

}
