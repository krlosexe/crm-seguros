<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientsPeople;
use App\Policies;
use App\ChargeAccount;
use App\ChargeManagement;

use Illuminate\Support\Facades\DB;

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

    public function Ganancias(){
        $data = Policies::selectRaw("SUM(policies_cousins_commissions.agency_commission) as total")
                            ->join("policies_cousins_commissions", "policies_cousins_commissions.id_policies", "=", "policies.id_policies", "left")
                            ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                          
                            ->where("auditoria.tabla", "policies")
                            ->where("auditoria.status", "!=", "0")
                            ->whereRaw('YEARWEEK(`fec_regins`, 1) = YEARWEEK(CURDATE(), 1)')
                            ->first();
        return response()->json($data)->setStatusCode(200);
    }


    public function Policies(){

        $total = Policies::join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                            ->where("auditoria.tabla", "policies")
                            ->where("auditoria.status", "!=", "0")
                            ->get();

        
        $expired = Policies::join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                            ->where("auditoria.tabla", "policies")
                            ->where("policies.state_policies", "Vencida")
                            ->where("auditoria.status", "!=", "0")
                            ->get();




        $porcentaje_expired = round((sizeof($expired) * 100) / sizeof($total));


        $array = array(
            "sold"        => array("total"   => sizeof($total),   "porcentaje" => 100),
            "renovations" => array("total"   => 0,                "porcentaje" => 0),
            "expired"     => array("total" => sizeof($expired), "porcentaje" => $porcentaje_expired)
        );

        return response()->json($array)->setStatusCode(200);

    }

    public function PoliciesExpired(Request $request){

        $fechadesde = $request->fecha_desde_polizas.' 00:00:00';
        $fechahasta = $request->fecha_hasta_polizas.' 23:59:59';

        $data = Policies::select("policies.*", 
                                 DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname"), 
                                 "clients_company.business_name")
                          ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                          ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")

                          ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                          ->where("auditoria.tabla", "policies")
                          ->where("auditoria.status", "!=", "0")
                          
                          ->where('auditoria.fec_regins', '>=', $fechadesde)
                          ->where('auditoria.fec_regins', '<=', $fechahasta)
                          
                          ->limit(10)

                          ->whereRaw("end_date between curdate() and date_add(curdate(), interval 7 day)")
                        
                          ->orderBy("policies.end_date", "ASC")

                          ->get();

        return response()->json($data)->setStatusCode(200);
                        
    }


    public function ChargeAccounPending(Request $request){
        $fechadesde = $request->fecha_desde_polizas.' 00:00:00';
        $fechahasta = $request->fecha_hasta_polizas.' 23:59:59';

        $data = ChargeManagement::allWithAuditoria($fechadesde, $fechahasta)->limit(10)->with(['client', 'company'])->get();

        return response()->json($data)->setStatusCode(200);


    }
}
