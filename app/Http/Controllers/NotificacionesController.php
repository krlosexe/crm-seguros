<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Notifications;
class NotificacionesController extends Controller
{
    
    public function remember(){
        //$this->SevenDays(-15);
        $this->SevenDays(-7);
        $this->Today();
    }


    public function SevenDays($days){
        $date = date("Y-m-d");
        
        $data = DB::table("policies")->whereRaw("TIMESTAMPDIFF(DAY,  policies.end_date, '".$date."') = '".$days."'")->get();


        $mensaje = "Pólizas Pronto a vencer\n\n";
        $datas = [];
        foreach($data as $value){
           // $mensaje .= "(fecha : ".$value->end_date.", numero : ".$value->number_policies."), \n";
           $datas[] = "(fecha : ".$value->end_date.", numero : ".$value->number_policies.")";
        }

        $info_email = [
            "email" =>   "cardenascarlos18@gmail.com",
            "issue"   => "Pólizas Pronto a vencer dentro de $days dias - Hoy ". date("Y-m-d"),
            "mensage" => $mensaje,
            "data"    => $datas
        ];

     
        if(sizeof($data) > 0 ){
            $this->SendEmail($info_email);
        }
    }


    public function Today(){
        $date = date("Y-m-d");
        
        $data = DB::table("policies")->whereRaw("end_date  = '".$date."'")->get();


        $mensaje = "Pólizas vencidas\n\n";
        $data = [];
        foreach($data as $value){
           // $mensaje .= "(fecha : ".$value->end_date.", numero : ".$value->number_policies."), \n";
           $data[] = "(fecha : ".$value->end_date.", numero : ".$value->number_policies.")";
        }

        $info_email = [
            "email" =>   "cardenascarlos18@gmail.com",
            "issue"   => "Pólizas Vencidas Hoy ". date("Y-m-d"),
            "mensage" => $mensaje,
            "data"    => $data
        ];

        if(sizeof($data) > 0 ){
            $this->SendEmail($info_email);
        }

    }





    public function SendEmail($data){
        $subject = $data["issue"];

        $users = DB::table("users")->select("email")->whereRaw("id_rol = 17 or id_rol = 19")->get()->pluck('email');
        
        $for = ["chasesoresenseguros@hotmail.com", "empresarial@chseguros.com.co","areatecnica@chseguros.com.co", "cardenascarlos18@gmail.com"];
       // echo json_encode($for);
        //dd($for);
        $request["msg"] = $data["mensage"];
        $request["data"] = $data["data"];
        Mail::send('emails.policies',$request, function($msj) use($subject,$for){
            $msj->from("sistema@chseguros.com.co","Sistemas CH Seguros");
            $msj->subject($subject);
            $msj->to($for);
        });
        return true;
    }




    public function Get(Request $request){
        $data = Notifications::where("id_user", $request["id_user"])
                            ->orderBy("id_notifications", "desc")
                            ->limit(10)
                            ->get();
        echo json_encode($data);

    }



    public function GetAll(Request $request){
        $data = Notifications::where("id_user", $request["id_user"])
                            ->orderBy("id_notifications", "desc")
                            ->get();

        return response()->json($data)->setStatusCode(200);
    }
}
