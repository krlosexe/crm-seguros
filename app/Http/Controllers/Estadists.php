<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientsPeople;
class Estadists extends Controller
{
    public function Clients(){
        
        
        $data = ClientsPeople::selectRaw("count(clients_people_contact.id_department) as count, clients_people_contact.id_department, departamentos.cod, departamentos.nombre, departamentos.color")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_people.id_clients_people")
                                ->join("departamentos", "departamentos.id", "=", "clients_people_contact.id_department")
                                ->where("auditoria.tabla", "clients_people")
                               
                                ->where("auditoria.status", "!=", "0")
                                ->where("clients_people_contact.id_department", "!=", "0")
                                ->orderBy("clients_people.id_clients_people", "DESC")
                                ->groupBy("clients_people_contact.id_department")
                                ->get();


        $total = 0;
        foreach($data as $value){
            $total = $total + $value["count"];
        }
        
        
        foreach($data as $value){
            $porcentaje = ($value["count"] * 100) / $total;
            $value["porcentaje"] = round($porcentaje);
        }



        return response()->json(["data" => $data, "total" => $total])->setStatusCode(200);
    }
}
