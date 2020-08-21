<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\CotizadorHogar;

class CotizacionesHogarController extends Controller
{


      public function paginate(Request $request)
      {

            ini_set('memory_limit', '-1'); 
            
            $searchValue = $request->search['value']; // value
            $start       = $request->start;
            $length      = $request->length;
            $draw        = $request->draw;


            // $query = DB::table('vehiculo_cotizador')->where('status', 1);
            $query = CotizadorHogar::select('cotizador_hogar.*', 
                                DB::raw("concat(cotizador_hogar_influencers.names, ' ', cotizador_hogar_influencers.last_names) as influencer_name")
                            )
                           ->where('cotizador_hogar.status', 1)
                           ->join('cotizador_hogar_influencers', 'cotizador_hogar_influencers.id', '=', 'cotizador_hogar.influencer_id', 'left');

                // se cuentan todos

                $dbTemp = Clone $query;
                $recordsTotal = $dbTemp->get()->count();
                // se aplica el filtro y se cuentan los registros filtrados

                $query->search($searchValue);

                $dbFiltered = Clone $query;
                $recordsFiltered = $dbFiltered->get()->count();

                $data = $query->orderBy('created_at', 'desc')->paginar($start, $length)->get();

            return response()->json([
                "draw"            => intval($draw),
                "recordsTotal"    => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data"            => $data
            ])->setStatusCode(200);
        }


    public function status($id, $status, Request $request){

            CotizadorHogar::find($id)->update(['status' => $status]);

            $data = array('mensagge' => "Eliminado correctamente"); 

            return response()->json($data)->setStatusCode(200);

    }

}
