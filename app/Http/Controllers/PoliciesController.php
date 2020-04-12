<?php

namespace App\Http\Controllers;

use App\Policies;
use App\Auditoria;
use App\PoliciesInfoTakerInsuredBeneficiary;
use App\PoliciesObservations;
use App\PoliciesCousinsCommissions;
use App\PoliciesNotifications;
use App\PoliciesInfoPayments;
use App\PoliciesBind;
use App\RecibosCobranza;
use App\PoliciesAnnexes;
use App\PolicesVehicles;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        ini_set('memory_limit', '-1'); 
        
        $searchValue = $request->search['value']; // value
        $start       = $request->start;
        $length      = $request->length;
        $draw        = $request->draw;

        $policiesQuery = Policies::select("policies.*", 
                                         "policies_info_taker_insured_beneficiary.*", 
                                         DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname"), 
                                    "clients_company.business_name",  "insurers.name as name_insurers", "branchs.name as name_branchs","policies_cousins_commissions.*",
                                    "policies_observations.*","policies_notifications.*", "policies_info_payments.*",
                                    "auditoria.*", "user_registro.email as email_regis")

                                ->join("policies_info_taker_insured_beneficiary", "policies_info_taker_insured_beneficiary.id_policies", "=", "policies.id_policies", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch")
                                ->join("policies_cousins_commissions", "policies_cousins_commissions.id_policies", "=", "policies.id_policies", "left")
                                ->join("policies_observations", "policies_observations.id_policies", "=", "policies.id_policies")
                                ->join("policies_notifications", "policies_notifications.id_policies", "=", "policies.id_policies", "left")
                                ->join("policies_info_payments", "policies_info_payments.id_policies", "=", "policies.id_policies")
                                
                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                                ->where("auditoria.tabla", "policies")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("policies_bind")

                                ->with("vehicules")

                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.id_policies", "DESC");

            // se cuentan todos los registros hasta este punto de la consulta

            $dbTemp = Clone $policiesQuery;
            $recordsTotal = $dbTemp->get()->count();

            // se aplica el filtro y se cuentan los registros filtrados

            $policiesQuery->search($searchValue);

            $dbFiltered = Clone $policiesQuery;
            $recordsFiltered = $dbFiltered->get()->count();

            // se obtienen los registros paginados
            $data = $policiesQuery->paginar($start, $length)->get();

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data
        ])->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage..
     *
     * @param  \Illuminate\Http\Request  $requestss
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            

            isset($request["is_renewable"])          ? $request["is_renewable"]           = 1 : $request["is_renewable"]          = 0;
            isset($request["beneficiary_remission"]) ? $request["beneficiary_remission"]  = 1 : $request["beneficiary_remission"] = 0;
            isset($request["beneficairy_onerous"])   ? $request["beneficairy_onerous"]    = 1 : $request["beneficairy_onerous"]   = 0;


            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;

            $store                  = Policies::create($request->all());
            $request["id_policies"] = $store->id_policies;
            
            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["participation"]         = (float) str_replace(',', '', $request["participation"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);

            PoliciesInfoTakerInsuredBeneficiary::create($request->all());
            PoliciesObservations::create($request->all());
            PoliciesInfoPayments::create($request->all());

            if($request["type_poliza"] != "Collective"){
                PoliciesCousinsCommissions::create($request->all());
                PoliciesNotifications::create($request->all());


                foreach($request->placas as $value){
                    $data["placa"]      = $value;
                    $data["id_policie"] = $store->id_policies;
                    PolicesVehicles::create($data);
                }

            }
            else{
                // Cuando es poliza collective, se almacenan los vinculados
                
                $all = $request->all();

                $binds = array();

                foreach ($all as $key => $item) {
                    if(strpos($key, '_bind')){
                        $str = preg_replace('/_bind/', '', $key);
  
                        foreach ($item as $index => $value) {
                             $binds[$index][$str] = $value;
                             $binds[$index]['id_policie'] = $store->id_policies;
                        }
                    }
                }

                foreach ($binds as $bind) {

                   $bindStore = PoliciesBind::create($bind);

                    $auditoria              = new Auditoria;
                    $auditoria->tabla       = "binds";
                    $auditoria->cod_reg     = $bindStore->id_policies_bind;
                    $auditoria->status      = 1;
                    $auditoria->usr_regins  = $request["id_user"];
                    $auditoria->save();
                }

            }

           $request["amount"] = $request["total"];
           $plan_pay = $this->SimulationPay($request);

           $data_plan = [];
           foreach($plan_pay->original as $key => $value){

               $value["id_policie"]     = $store->id_policies;
               $value["type_operation"] = 'C';
               $value["payment"]        = 0;
               $value["balance"]        = $value["amount"];
               $value["status"]         = 0;
               $data_plan[] = $value;
              
           }

            RecibosCobranza::insert($data_plan);
            
            $auditoria              = new Auditoria;
            $auditoria->tabla       = "policies";
            $auditoria->cod_reg     = $store->id_policies;
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            if ($store) {
                $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function show($policies)
    {
        $policie = Policies::select("policies.*", "policies_info_taker_insured_beneficiary.*", "clients_people.names", "clients_people.last_names", 
                                    "clients_company.business_name",  "insurers.name as name_insurers", "branchs.name as name_branchs","policies_cousins_commissions.*",
                                    "policies_observations.*","policies_notifications.*", "policies_info_payments.*",
                                    "auditoria.*", "user_registro.email as email_regis")

                                ->join("policies_info_taker_insured_beneficiary", "policies_info_taker_insured_beneficiary.id_policies", "=", "policies.id_policies", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch")
                                ->join("policies_cousins_commissions", "policies_cousins_commissions.id_policies", "=", "policies.id_policies", "left")
                                ->join("policies_observations", "policies_observations.id_policies", "=", "policies.id_policies")
                                ->join("policies_notifications", "policies_notifications.id_policies", "=", "policies.id_policies", "left")
                                ->join("policies_info_payments", "policies_info_payments.id_policies", "=", "policies.id_policies")
                                
                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                                ->where("auditoria.tabla", "policies")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("policies_bind")

                                ->where("policies.id_policies", $policies)

                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.id_policies", "DESC")
                                ->get();
           
        return response()->json($policie[0])->setStatusCode(200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function edit(Policies $policies)
    {
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $policies)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){


            isset($request["is_renewable"])          ? $request["is_renewable"]           = 1 : $request["is_renewable"]          = 0;
            isset($request["beneficiary_remission"]) ? $request["beneficiary_remission"]  = 1 : $request["beneficiary_remission"] = 0;
            isset($request["beneficairy_onerous"])   ? $request["beneficairy_onerous"]    = 1 : $request["beneficairy_onerous"]   = 0;


            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;



            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["participation"]         = (float) str_replace(',', '', $request["participation"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);


            
            
            $update = Policies::find($policies)->update($request->all());
            PoliciesInfoTakerInsuredBeneficiary::find($policies)->update($request->all());
            PoliciesObservations::find($policies)->update($request->all());
            PoliciesInfoPayments::find($policies)->update($request->all());

            if($request["type_poliza"] != "Collective"){
                PoliciesCousinsCommissions::find($policies)->update($request->all());
                PoliciesNotifications::find($policies)->update($request->all());
            }

            

            if ($update) {
                $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }


    public function Binds($id_policie, Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $modulos = PoliciesBind::select("policies_bind.*","auditoria.*", "user_registro.email as email_regis")

                                    ->join("auditoria", "auditoria.cod_reg", "=", "policies_bind.id_policies_bind")
                                    ->where("auditoria.tabla", "binds")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                    ->where("auditoria.status", "!=", "0")

                                    ->where("policies_bind.id_policie", $id_policie)
                                    ->orderBy("policies_bind.id_policies_bind", "DESC")
                                    ->get();

            return response()->json($modulos)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function StoreBinds(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            
            $request["cousin"]          = str_replace(',', '', $request["cousin"]);
            $request["percentage_vat"]  = str_replace(',', '', $request["percentage_vat"]);
            $request["expenses"]        = str_replace(',', '', $request["expenses"]);
            $request["vat"]             = str_replace(',', '', $request["vat"]);
            $request["total"]           = str_replace(',', '', $request["total"]);

            $store                  = PoliciesBind::create($request->all());
            $auditoria              = new Auditoria;
            $auditoria->tabla       = "binds";
            $auditoria->cod_reg     = $store->id_policies_bind;
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            if ($store) {
                $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
            
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function UpdateBinds(Request $request, $bind)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $request["cousin"]          = str_replace(',', '', $request["cousin"]);
            $request["percentage_vat"]  = str_replace(',', '', $request["percentage_vat"]);
            $request["expenses"]        = str_replace(',', '', $request["expenses"]);
            $request["vat"]             = str_replace(',', '', $request["vat"]);
            $request["total"]           = str_replace(',', '', $request["total"]);

            $update = PoliciesBind::find($bind)->update($request->all());

            if ($update) {
                $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function StatusBinds($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "binds")->first();

            $auditoria->status = $status;

            if($status == 0){
                $auditoria->usr_regmod = $request["id_user"];
                $auditoria->fec_regmod = date("Y-m-d");
            }
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }


    public function status($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "policies")->first();

            $auditoria->status = $status;

            if($status == 0){
                $auditoria->usr_regmod = $request["id_user"];
                $auditoria->fec_regmod = date("Y-m-d");
            }
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function SimulationPay(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            if($request["payment_method"] == "Contado"){
                $data = array(
                    "monthly_fee"  => 1,
                    "payment_date" => $request["payment_date"],
                    "amount"       => $request["amount"]
                );
                $simulation[] = $data;
            }else{

                if($request["payment_period"] == "Mensual"){
                    $payment_period = 1;
                }

                if($request["payment_period"] == "Bimensual"){
                    $payment_period = 2;
                }

                if($request["payment_period"] == "Trimestral"){
                    $payment_period = 3;
                }

                if($request["payment_period"] == "Semestral"){
                    $payment_period = 6;
                }

                if($request["payment_period"] == "Anual"){
                    $payment_period = 12;
                }

                $num_cuotas = $request["payment_terms"] / $payment_period;

                $inicio_pago  = $request["payment_date"];

                for($i = 1; $i <= $num_cuotas; $i++){

                    $valores_fecha  = explode("-", $inicio_pago);

                    if ($i == 1) {
                        $dia_inicio = $valores_fecha[2];
                        $fecha_recorrido = $valores_fecha[0]."-".$valores_fecha[1]."-".$valores_fecha[2];
                        $inicio_pago     = $fecha_recorrido;
                    }else{

                        $dia    = $valores_fecha[2];
                        $mes_2  = ($valores_fecha[1] + $payment_period);
                        $year   = $valores_fecha[0];

                        $mes_tem   = $valores_fecha[1];
                        $year_temp = $year;

                        $mes    = date('m', mktime(0, 0, 0, $mes_2,  1, $year));
                        $year   = date('Y', mktime(0, 0, 0, $mes_2,  1, $year)); 
                    
                        if (checkdate($mes, $dia, $year)) {
                            $fecha_recorrido = $year."-".$mes."-".$dia;
                        }else{
                            $dia = $dia - 1;
                            $i   = $i   - 1;
                            $fecha_recorrido = $year_temp."-".$mes_tem."-".$dia;
                            $inicio_pago     = $fecha_recorrido;
                            continue;
                        }
    
                        $inicio_pago     = $year."-".$mes."-".$dia_inicio;

                    }

                    $data = array(
                        "monthly_fee"  => $i,
                        "payment_date" => $fecha_recorrido,
                        "amount"       => (str_replace(',', '', $request["amount"]) /  $num_cuotas)
                    );

                    $simulation[] = $data;
                }
                
            }

            return response()->json($simulation)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    function GetPays($id_policie){

        $data = RecibosCobranza::where("id_policie", $id_policie)->get();
        return response()->json($data)->setStatusCode(200);
    }


    public function StoreAnnexes(request $request){
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            

            isset($request["is_renewable"]) ? $request["is_renewable"]  = 1 : $request["is_renewable"] = 0;

            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);
            
            $store                  = PoliciesAnnexes::create($request->all());
            $request["id_policies_annexes"] = $store->id_policies_annexes;
 

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "policies_annexes";
            $auditoria->cod_reg     = $store->id_policies_annexes;
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            if ($store) {
                $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
            
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }   



    public function UpdateAnnexes(Request $request, $annexe)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            isset($request["is_renewable"]) ? $request["is_renewable"]  = 1 : $request["is_renewable"] = 0;

            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);

            $update = PoliciesAnnexes::find($annexe)->update($request->all());

            if ($update) {
                $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }







    public function GetAnnexes($policies)
    {
        $policie = PoliciesAnnexes::select("policies_annexes.*", "auditoria.*", "user_registro.email as email_regis")

                                            ->join("auditoria", "auditoria.cod_reg", "=", "policies_annexes.id_policies_annexes")
                                            ->where("auditoria.tabla", "policies_annexes")
                                            ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                            ->where("policies_annexes.id_policie", $policies)

                                            ->where("auditoria.status", "!=", "0")
                                            ->orderBy("policies_annexes.id_policies_annexes", "DESC")
                                            ->get();
           
        return response()->json($policie)->setStatusCode(200);
    }

    public function GetAnnexesById($annexe)
    {
        $policie = PoliciesAnnexes::select("policies_annexes.*", "auditoria.*", "user_registro.email as email_regis")

                                            ->join("auditoria", "auditoria.cod_reg", "=", "policies_annexes.id_policies_annexes")
                                            ->where("auditoria.tabla", "policies_annexes")
                                            ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                            ->where("policies_annexes.id_policies_annexes", $annexe)

                                            ->where("auditoria.status", "!=", "0")
                                            ->orderBy("policies_annexes.id_policies_annexes", "DESC")
                                            ->get();
           
        return response()->json($policie[0])->setStatusCode(200);
    }


    



    public function StatusAnnexes($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "policies_annexes")->first();

            $auditoria->status = $status;

            if($status == 0){
                $auditoria->usr_regmod = $request["id_user"];
                $auditoria->fec_regmod = date("Y-m-d");
            }
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }


    public function GetVehicule($placa){

        $data = PolicesVehicles::select("policies_vehicle.*", "fasecolda.clase", "fasecolda.marca", "fasecolda.referencia1", 
                                        "fasecolda.referencia2", "fasecolda.referencia3", "insurers.name as name_insurers", "insurers.phone")
                                    
                                    ->join("policies", "policies.id_policies", "=", "policies_vehicle.id_policie")
                                    ->join("vehicules", "vehicules.placa", "=", "policies_vehicle.placa")
                                    ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code")
                                    ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                    ->where("policies_vehicle.placa", $placa)
                                    ->first();
        if($data){
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("La Placa no se encuentra asegurada")->setStatusCode(400);
        }
        
    }



    public function GetCLientSoat($cedula){
        $data = Policies::select("policies.number_policies","policies.start_date", "policies.end_date", "clients_people.type_document", "clients_people.number_document")
                            ->join("branchs", "branchs.id_branchs", "=", "policies.branch")
                            ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients")
                            ->where("clients_people.number_document", $cedula)
                            ->where('branchs.name', 'like', '%SOAT%')
                            ->get();

        return response()->json($data)->setStatusCode(200);
    }



    /**
     * Remove the specified resource from storage.
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policies $policies)
    {
        
    }
}
