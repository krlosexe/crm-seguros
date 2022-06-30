<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use App\Notifications;
use App\User;


class Policies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:policies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pólizas Vencidas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->RememberDays(-15);
        $this->RememberDays(-7);
        $this->Today();
    }




    public function RememberDays($days){
        $date = date("Y-m-d");
        
        $data = DB::table("policies")->whereRaw("TIMESTAMPDIFF(DAY,  policies.end_date, '".$date."') = '".$days."'")->get();

        $users = User::where("id_rol", 17)->OrWhere("id_rol", 19)->OrWhere("id_rol", 6)->get();

        $mensaje = "Pólizas Pronto a vencer\n\n";
        $datas = [];
        foreach($data as $value){
            $this->line($value->number_policies." Policies");
           // $mensaje .= "(fecha : ".$value->end_date.", numero : ".$value->number_policies."), \n";
           $datas[] = "(fecha : ".$value->end_date.", número : ".$value->number_policies.")";


           foreach($users as $user){
                //$this->line($value->id." User");
                Notifications::create([
                    "fecha"   => date("Y-m-d"),
                    "title"   => "Póliza pronto a vencer, fecha : ".$value->end_date.", número : ".$value->number_policies."",
                    "id_policie" => $value->id_policies,
                    "id_user" => $user->id,
                    "view"    => "No"
                ]);
            }


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

        $this->line($mensaje);

    }


    public function Today(){
        $date = date("Y-m-d");
        
        $data = DB::table("policies")->whereRaw("end_date  = '".$date."'")->get();
        $users = User::where("id_rol", 17)->OrWhere("id_rol", 19)->OrWhere("id_rol", 6)->get();


        $mensaje = "Pólizas vencidas\n\n";
        $datas = [];
        foreach($data as $value){
            $this->line($value->number_policies." Policies");
           // $mensaje .= "(fecha : ".$value->end_date.", numero : ".$value->number_policies."), \n";
           $datas[] = "(fecha : ".$value->end_date.", número : ".$value->number_policies.")";


           foreach($users as $user){
            //$this->line($value->id." User");
            Notifications::create([
                "fecha"   => date("Y-m-d"),
                "title"   => "Póliza pronto a vencer, fecha : ".$value->end_date.", número : ".$value->number_policies."",
                "id_policie" => $value->id_policies,
                "id_user" => $user->id,
                "view"    => "No"
            ]);
        }



        }

        $info_email = [
            "email" =>   "cardenascarlos18@gmail.com",
            "issue"   => "Pólizas Vencidas Hoy ". date("Y-m-d"),
            "mensage" => $mensaje,
            "data"    => $datas
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



}
