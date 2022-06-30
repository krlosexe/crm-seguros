<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\VehiculoCotizador;
use Mail;
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

        
            $id_rol = $request["id_rol"];
            $id_adviser = 0;
            if($id_rol == 24){
                $user = DB::table("users")->where("id", $request["id_user"])->first();
                $id_adviser = $user->id_adviser;
            }


            // $query = DB::table('vehiculo_cotizador')->where('status', 1);
            $query = VehiculoCotizador::selectRaw("vehiculo_cotizador.*, advisers.name")
                                        ->join("advisers", "advisers.id", "=", "vehiculo_cotizador.id_adviser", "left")
                                        ->where(function($query) use ($id_rol, $id_adviser){
                                            if($id_rol == 24){
                                                $query->where("vehiculo_cotizador.id_adviser", $id_adviser);
                                            }
                                        })
                                        ->where('status', 1);

                // se cuentan todos

                $dbTemp = Clone $query;
                $recordsTotal = $dbTemp->get()->count();
                // se aplica el filtro y se cuentan los registros filtrados

                $query->search($searchValue);

                $dbFiltered = Clone $query;
                $recordsFiltered = $dbFiltered->get()->count();

                $data = $query->orderBy('created_at', 'desc')->paginar($start, $length)->get();

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



    public function CommentCotizacion(Request $request){
        DB::table("vehiculo_cotizador_comentarios")->insert($request->all());
        return response()->json("Ok")->setStatusCode(200);
    }   


    public function GetCommentCotizacion($id_cotizacion){
        $data = DB::table("vehiculo_cotizador_comentarios")
                    ->selectRaw("vehiculo_cotizador_comentarios.*, users.email, users.img_profile, datos_personales.nombres as name_user,  datos_personales.apellido_p as last_name_user")
                    ->join('users', 'users.id', '=', 'vehiculo_cotizador_comentarios.id_user')  
                    ->join('datos_personales', 'datos_personales.id_usuario', '=', 'vehiculo_cotizador_comentarios.id_user') 
                    ->where("id_cotizacion", $id_cotizacion)
                    ->orderBy("vehiculo_cotizador_comentarios.id", "DESC")
                    ->get();

        return response()->json($data)->setStatusCode(200);
    }



    public function EmailCotizador(Request $request){
       
   
        
        $subject = $request["issue"];
        $for     = [$request["email"]];

        $data["nombre"]     = $request["name"];
        $data["vehiculo"]   = $request["vehiculo"];
        $data["cotizacion"] = $request["cotizacion"];

    
        Mail::send('emails.policiesCotizacion',$data, function($msj) use($subject,$for){
            $msj->from("sistema@chseguros.com.co","Sistemas CH Seguros");
            $msj->subject($subject);
            $msj->to($for);
        });




        $cotizacion = DB::table("vehiculo_cotizador")->where("id_vehiculo", $request["id_vehiculo_cotizacion"])
                        ->join("advisers", "advisers.id", "=", "vehiculo_cotizador.id_adviser")
                        ->first();


        $for         = $cotizacion->email;
        $subject     = "Nueva ".$request["issue"]." ".$request["name"];
        $data["msg"] = "Nueva cotización\n
                        Placa: $cotizacion->placa \n
                        Nombre: $request[name] \n
                        Documento: $cotizacion->documento_identidad\n
                        Email: $cotizacion->correo \n
                        Teléfono: $cotizacion->phone";
        Mail::send('emails.notification',$data, function($msj) use($subject,$for){
            $msj->from("sistema@chseguros.com.co","Sistemas CH Seguros");
            $msj->subject($subject);
            $msj->to($for);
        });
        

        return response()->json($data, 200);
       
            
    }
}
