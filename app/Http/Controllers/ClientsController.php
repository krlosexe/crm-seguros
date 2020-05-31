<?php

namespace App\Http\Controllers;

use App\User;
use App\Clients;
use App\Auditoria;
use App\ClientsPeople;
use App\ClientsCompany;
use App\datosPersonaesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function GetClients(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $clientsPeople = ClientsPeople::select("clients_people.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_people.id_clients_people")
                                ->where("auditoria.tabla", "clients_people")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_people.id_clients_people", "DESC")
                                ->get();


            $clientsCompany = ClientsCompany::select("clients_company.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_company.id_clients_company")
                                ->where("auditoria.tabla", "clients_company")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_company.id_clients_company", "DESC")
                                ->get();

            
            $data = array("clients_people" => $clientsPeople, "clients_company" => $clientsCompany);
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }




    public function CreateUser(){
       
        ini_set('max_execution_time', 180);

        $clientsPeople = ClientsPeople::select("clients_people.*", "clients_people_contact.*","auditoria.*", "user_registro.email as email_regis")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_people.id_clients_people")
                                ->where("auditoria.tabla", "clients_people")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_people.id_clients_people", "DESC")
                                ->get();

        foreach($clientsPeople as $value){
           


            $User              = new User;
            $User->email       = $value["number_document"];
            $User->password    = md5($value["number_document"]);
            $User->id_rol      = 18;
            
            $User->save();



            $datos_personales                   = new datosPersonaesModel;
            $datos_personales->nombres          = $value["names"];
            $datos_personales->apellido_p       = $value["last_names"];
            $datos_personales->n_cedula         = $value["number_document"];
            $datos_personales->fecha_nacimiento = $value["birthdate"];
            $datos_personales->id_usuario       = $User->id;
            $datos_personales->save();

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "users";
            $auditoria->cod_reg     = $User->id;
            $auditoria->status      = 1;
            $auditoria->usr_regins  = 1;
            $auditoria->save();


            echo json_encode($User)."<br><br>";

        }
    }
   
}
