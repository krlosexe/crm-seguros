<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Auditoria;
use App\ClientsPeople;
use App\ClientsCompany;
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
   
}
