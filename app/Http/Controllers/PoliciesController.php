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
use App\PoliciesFamiliares;
use App\PoliciesFamilyBurden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\ClientsPeople;
use App\ClientsCompany;
use App\Files;

use Illuminate\Support\Facades\DB;

use App\User;
use App\datosPersonaesModel;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        ini_set('memory_limit', '-1'); 

        
        $data = Policies::select("policies.*", "policies_info_taker_insured_beneficiary.*", "clients_people.names", "clients_people.last_names", 
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
                                ->orderBy("policies.id_policies", "DESC")
                                ->get();
           
        return response()->json($data)->setStatusCode(200);

    }

    public function policiesLight(){

        $data = Policies::select(
                                 "policies.id_policies", 
                                 "policies.number_policies"
                                 )
                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                                ->where("auditoria.tabla", "policies")
                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.id_policies", "DESC")
                                ->get();
           
        return response()->json($data)->setStatusCode(200);
        
    }

    public function paginate(Request $request)
    {

        ini_set('memory_limit', '-1'); 
        
        $searchValue = $request->search['value']; // value
        $start       = $request->start;
        $length      = $request->length;
        $draw        = $request->draw;

        $policiesQuery = Policies::select(
                                    "policies.id_policies"
                                   )

                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch")

                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")

                                ->where("auditoria.tabla", "policies")
                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.state_policies", "asc");    

            // se cuentan todos

            $dbTemp = Clone $policiesQuery;
            $recordsTotal = $dbTemp->get()->count();

            // se aplica el filtro y se cuentan los registros filtrados
            if($request->proximas_a_vencer == '1'){
                $policiesQuery->whereRaw("policies.end_date between curdate() and date_add(curdate(), interval 7 day)");
            }

            $policiesQuery->search($searchValue);

            $dbFiltered = Clone $policiesQuery;
            $recordsFiltered = $dbFiltered->get()->count();

            // Select completo final con relaciones 

            $policiesQuery->select(
                                    "policies.*", 
                                    "insurers.name as name_insurers", 
                                    "branchs.name as name_branchs",
                                    "clients_people.names", 
                                    "clients_people.last_names", 
                                    "clients_company.business_name",  
                                    DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname"), 
                                    "auditoria.*"
                                );

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

            $file = $request->file('file');

            if($file != null){
                
                $pathinfo = pathinfo($file->getClientOriginalName());
                $currentTime = date('YmdHis');

                if($pathinfo['extension'] == 'PDF'){
                    $name = $pathinfo['filename']."-$currentTime".'.pdf';
                }
                else{
                    $name = $pathinfo['filename']."-$currentTime" .".$pathinfo[extension]";
                }

                $file->move('img/policies/caratulas',$name);
                
                $request['file_caratula'] = $name;
                
            }

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

            if(isset($request->familiar_id)){

                foreach ($request->familiar_nombre as $key => $value) {

                    $familiares['nombre'] = $value;
                    $familiares['documento'] = $request->familiar_documento[$key];
                    $familiares['id_policies'] = $store->id_policies;

                    PoliciesFamiliares::create($familiares);

                }
            }

            // esto se movio a storeBinds

            // if(isset($request->name_familyBurden)):

            //     foreach ($request->name_familyBurden as $key => $value) {

            //         $cargaFamiliar['name']         = $value;
            //         $cargaFamiliar['document']     = $request->document_familyBurden[$key];
            //         $cargaFamiliar['birthdate']    = $request->birthdate_familyBurden[$key];
            //         $cargaFamiliar['relationship'] = $request->relationship_familyBurden[$key];
            //         $cargaFamiliar['date_init']    = $request->startDate_familyBurden[$key];
            //         $cargaFamiliar['cousin']       = $request->cousin_familyBurden[$key];
            //         $cargaFamiliar['id_policie']   = $store->id_policies;

            //         PoliciesFamilyBurden::create($cargaFamiliar);

            //     }
            // endif;

            if($request["type_poliza"] != "Collective"){
                PoliciesCousinsCommissions::create($request->all());
                PoliciesNotifications::create($request->all());

                if($request->placas != null){

                    foreach($request->placas as $value){
                        $data["placa"]      = $value;
                        $data["id_policie"] = $store->id_policies;
                        PolicesVehicles::create($data);
                    }
                    
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
        $policie = Policies::select(
                                    "policies.*", 
                                    "policies_info_taker_insured_beneficiary.*", 
                                    "clients_people.names", 
                                    "clients_people.last_names", 
                                    "clients_company.business_name",  
                                    "insurers.name as name_insurers", 
                                    "branchs.name as name_branchs",
                                    "policies_cousins_commissions.*",
                                    "policies_observations.*",
                                    "policies_notifications.*", 
                                    "policies_info_payments.*",
                                    "auditoria.*", "user_registro.email as email_regis",
                                    DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname")
                                    )

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

                                ->with("familiares")

                                ->where("policies.id_policies", $policies)

                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.id_policies", "DESC")
                                ->first();

           
        return response()->json($policie)->setStatusCode(200);
    }

    // Endpoint para consultar con la ID de un cliente, sus polizas

    public function PoliciesByClients($number_document){


         $cliente = ClientsPeople::with('policies')->where('number_document', trim($number_document))->first();

         if($cliente == null)
            $cliente = ClientsCompany::with('policies')->where('nit', trim($number_document))->first();

        
        if($cliente == null){
            $cliente = new \stdClass;
        }

         $cliente->binds = PoliciesBind::with('policie_parent')
                                ->select("policies_bind.*", "auditoria.*")
                                ->join("auditoria", "auditoria.cod_reg", "=", "policies_bind.id_policies_bind")
                                ->where("auditoria.tabla", "binds")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                ->where("policies_bind.document_affiliate", trim($number_document))
                                ->orderBy("policies_bind.id_policies_bind", "DESC")
                                ->get();
            
         return response()->json($cliente)->setStatusCode(200);
 
    }
    // Endpoint para consultar con la ID de un cliente, sus polizas

    public function PoliciesByBind($id_policies_bind){
        $policie_bind = PoliciesBind::select("policies_bind.*","auditoria.*", "user_registro.email as email_regis")

                                ->join("auditoria", "auditoria.cod_reg", "=", "policies_bind.id_policies_bind")
                                ->where("auditoria.tabla", "binds")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")

                                ->where("policies_bind.id_policies_bind", $id_policies_bind)
                                ->orderBy("policies_bind.id_policies_bind", "DESC")
                                ->first();

        
        if($policie_bind != null){
            $policie_bind->policies_family_burden_data = PoliciesFamilyBurden::where('id_policie', $policie_bind->id_policies_bind)->get();
        }
        

        $data['policie_bind'] = $policie_bind == null? array() : $policie_bind;
        $data['policie_parent'] = $policie_bind == null? array() : Policies::with([
                        'policies_info_taker_insured_beneficiary',
                        'policies_cousins_commissions',
                        'policies_observations',
                        'policies_notifications',
                        'policies_info_payments',
                        'policies_bind',
                        'branch_data',
                        'insurers_data',
                    ])
                    ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                    ->where("auditoria.tabla", "policies")
                    ->where("auditoria.status", "!=", "0")
                    ->where('policies.id_policies', $policie_bind->id_policie)
                    ->where('policies.state_policies', 'Vigente')
                    ->first();

            
         return response()->json($data)->setStatusCode(200);
 
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

            $file = $request->file('file');

            
            if($file != null){
                
                $pathinfo = pathinfo($file->getClientOriginalName());
                $currentTime = date('YmdHis');

                if($pathinfo['extension'] == 'PDF'){
                    $name = $pathinfo['filename']."-$currentTime".'.pdf';
                }
                else{
                    $name = $pathinfo['filename']."-$currentTime" .".$pathinfo[extension]";
                }

                $file->move('img/policies/caratulas',$name);
                
                $request['file_caratula'] = $name;
                
            }

            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["participation"]         = (float) str_replace(',', '', $request["participation"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);
            
            $update = Policies::find($policies)->update($request->all());

            $infoTaker = PoliciesInfoTakerInsuredBeneficiary::find($policies);

            if($infoTaker != null)
                $infoTaker->update($request->all());

            $obs = PoliciesObservations::find($policies);

            if($obs != null)
                $obs->update($request->all());

            $infoPay = PoliciesInfoPayments::find($policies);
            
            if($infoPay != null)
                $infoPay->update($request->all());


            $policie = Policies::find($policies);

            if(isset($request->familiar_id)){

                $familiaresMap = PoliciesFamiliares::select('id')->where('id_policies', $policie->id_policies)->get()->toArray();


                $familiaresMap = array_map(function($item){
                    return $item['id'];
                }, $familiaresMap);


                foreach ($request->familiar_nombre as $key => $value) {

                    $familiares['nombre'] = $value;
                    $familiares['documento'] = $request->familiar_documento[$key];
                    $familiares['id_policies'] = $policie->id_policies;

                    if(in_array($request->familiar_id[$key], $familiaresMap)){

                        $key = array_search($request->familiar_id[$key], $familiaresMap);

                        unset($familiaresMap[$key]);

                        PoliciesFamiliares::find($request->familiar_id[$key])->update($familiares);

                    }
                    else if($request->familiar_id[$key] == 0){

                        PoliciesFamiliares::create($familiares);

                    }

                }

                foreach ($familiaresMap as $value) {
                    PoliciesFamiliares::find($value)->delete();
                }

            }
            else{
                PoliciesFamiliares::where('id_policies', $policie->id_policies)->delete();
            }


            if($request->placas != null){
                PolicesVehicles::where('id_policie', $policie->id_policies)->delete();

                foreach($request->placas as $value){
                    $data["placa"]      = $value;
                    $data["id_policie"] = $policie->id_policies;
                    PolicesVehicles::create($data);
                }
                
            }

           PoliciesFamilyBurden::where('id_policie', $policie->id_policies)->delete();

            if($request["type_poliza"] != "Collective"){
                $comision =  PoliciesCousinsCommissions::find($policies);

                if($comision != null)
                    $comision->update($request->all());

                $notify = PoliciesNotifications::find($policies);

                if($notify != null)
                    $notify->update($request->all());
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
                                    
            foreach ($modulos as $key => $mod) {
                 $mod->policies_family_burden_data = PoliciesFamilyBurden::where('id_policie', $mod->id_policies_bind)->get();
            }

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

            $file = $request->file('file');

            if($file != null){
                
                $pathinfo = pathinfo($file->getClientOriginalName());

                if($pathinfo['extension'] == 'PDF'){
                     $name = $pathinfo['filename']."-$currentTime".'.pdf';
                }
                else{
                     $name = $pathinfo['filename']."-$currentTime" .".$pathinfo[extension]";
                }

                $file->move('img/policies/caratulas',$name);
                
                $request['file_caratula'] = $name;
                
            }


            $store                  = PoliciesBind::create($request->all());
            

            if(
               User::where('email', $store->document_affiliate)->first() == null 
                && 
               ($store->document_affiliate != null && $store->document_affiliate != '')
             ){

               $this->createUser($store);
            }

            if(isset($request->name_familyBurden)):

                foreach ($request->name_familyBurden as $key => $value) {

                    $cargaFamiliar['name']         = $value;
                    $cargaFamiliar['document']     = $request->document_familyBurden[$key];
                    $cargaFamiliar['birthdate']    = $request->birthdate_familyBurden[$key];
                    $cargaFamiliar['relationship'] = $request->relationship_familyBurden[$key];
                    $cargaFamiliar['date_init']    = $request->startDate_familyBurden[$key];
                    $cargaFamiliar['cousin']       = $request->cousin_familyBurden[$key];
                    $cargaFamiliar['id_policie']   = $store->id_policies_bind;

                    PoliciesFamilyBurden::create($cargaFamiliar);

                }
            endif;

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

            PoliciesFamilyBurden::where('id_policie', $bind)->delete();

            if(isset($request->name_familyBurden)):

                foreach ($request->name_familyBurden as $key => $value) {

                    $cargaFamiliar['name']         = $value;
                    $cargaFamiliar['document']     = $request->document_familyBurden[$key];
                    $cargaFamiliar['birthdate']    = $request->birthdate_familyBurden[$key];
                    $cargaFamiliar['relationship'] = $request->relationship_familyBurden[$key];
                    $cargaFamiliar['date_init']    = $request->startDate_familyBurden[$key];
                    $cargaFamiliar['cousin']       = $request->cousin_familyBurden[$key];
                    $cargaFamiliar['id_policie']   = $bind;

                    PoliciesFamilyBurden::create($cargaFamiliar);

                }
            endif;

            $file = $request->file('file');

           
            if($file != null){
                
                $pathinfo = pathinfo($file->getClientOriginalName());
                $currentTime = date('YmdHis');

                if($pathinfo['extension'] == 'PDF'){
                    $name = $pathinfo['filename']."-$currentTime".'.pdf';
                }
                else{
                    $name = $pathinfo['filename']."-$currentTime" .".$pathinfo[extension]";
                }

                $file->move('img/policies/caratulas',$name);
                
                $request['file_caratula'] = $name;
                
            }

            $update = PoliciesBind::find($bind);
            $documentoOriginal = $update->document_affiliate;
            $update->update($request->all());

            $this->updatedUser($documentoOriginal, $update);


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

                $bind = PoliciesBind::find($id);

                $this->checkDestroyUser($bind->document_affiliate, true);

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

    function deleteCaratulaBinds(Request $request){
        $policie = PoliciesBind::find($request->key);

        $file = $policie->file_caratula;

        $policie->file_caratula = null;
        $policie->save();

        File::delete(public_path().'/img/policies/caratulas/'.$file);

        return response()->json([], 200);
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
 
            $destinationPath        = 'img/policies/annexes';
            $request["tabla"]       = "policies_annexes";
            $request["id_register"] = $store["id_policies_annexes"];

            if($request->file('file')){
                foreach($request->file('file') as $key => $value){
                    $value->move($destinationPath,$value->getClientOriginalName());
    
                    $request["name"] = $value->getClientOriginalName();
    
                    $request["title"]       = $request["titles"][$key];
                    $request["descripcion"] = $request["descriptions"][$key];
    
                    $store_file = Files::create($request->all());
    
                    $auditoria              = new Auditoria;
                    $auditoria->tabla       = "files";
                    $auditoria->cod_reg     = $store_file["id_files"];
                    $auditoria->status      = 1;
                    $auditoria->usr_regins  = $request["id_user"];
                    $auditoria->save();
                }
            }

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
                                            ->orderBy("auditoria.fec_regins", "DESC")
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
                                            ->orderBy("auditoria.fec_regins", "DESC")
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
        $soats = DB::table('branchs')->where('name', 'like', '%soat%')->get()->toArray();

        $soats = array_map(function($item){
            return $item->id_branchs;
        }, $soats);

        $data = PolicesVehicles::select(
                                        "policies_vehicle.*", 
                                        "fasecolda.clase", 
                                        "fasecolda.marca", 
                                        "fasecolda.referencia1", 
                                        "fasecolda.referencia2", 
                                        "fasecolda.referencia3", 
                                        "insurers.name as name_insurers", 
                                        "insurers.phone"
                                    )
                                    ->join("policies", "policies.id_policies", "=", "policies_vehicle.id_policie")
                                    ->join("vehicules", "vehicules.placa", "=", "policies_vehicle.placa")
                                    ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code")
                                    ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                    ->where("policies_vehicle.placa", $placa)
                                    ->whereNotIn("policies.branch", $soats)
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

    public function getCitasSalud($cedula){

        $cliente = ClientsPeople::select('id_clients_people as id')->where('number_document', $cedula)->first();
        $type_client = 0;
        $bind = null;

        if($cliente == null){
            $cliente = ClientsCompany::select('id_clients_company as id')->where('nit', $cedula)->first();
            $type_client = 1;
        }
        
        if($cliente == null){
            $cliente = PoliciesBind::where('document_affiliate', trim($cedula))->first();
        
            if($cliente != null){

               $where = [
                    'id_policies' => $cliente->id_policie,
                    'state_policies' => 'Vigente'
                ];

            }

        }
        else{
            $where = [
                'type_clients' => $type_client,
                'clients' => $cliente->id,
                'state_policies' => 'Vigente',
            ];
        }

        if($cliente == null)
            return response()->json([])->setStatusCode(200);

        $data = Policies::where($where)
                ->where('branchs.name', 'like', '%SALUD%')
                ->join('branchs', 'branchs.id_branchs', "=", "policies.branch")
                ->with(['branch_data', 'insurers_data'])
                ->get();

        $resp = array();

        foreach ($data as $key => $value) {
            $info = [
                'insurers_id' => $value->insurers_data->id_insurers,
                'insurers_name' => $value->insurers_data->name,
                'number_policies' => $value->number_policies,
                'link' => $value->insurers_data->link_cita,
                'file_caratula' => $value->file_caratula,
            ];

            array_push($resp, $info);
        }
        

        return response()->json($resp)->setStatusCode(200);
    }



    /**
     * Remove the specified resource from storage.
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policies $policies)
    {
        
    }

    public function select2polizas(Request $request){
        $data = Policies::select('number_policies', 'id_policies')->where('number_policies', 'like', '%'.$request['search'].'%')->limit(10)->get();

        return response()->json($data);
    }


    public function updatedUser($number_document, $update){

        // Se busca en clientes, company y policie_bind si el numero de documento anterior existe
        // Si no existe ningun registro con el numero de documento, entonces se puede eliminar el usuario

        if($number_document != $update->document_affiliate){

            $this->checkDestroyUser($number_document);

            $this->createUser($update);
        }


    }

    public function checkDestroyUser($number_document, $forceDelete = false){

        $client = ClientsPeople::where('number_document', trim($number_document))->first();
        $company = ClientsCompany::where('nit', trim($number_document))->first();
        $bind = PoliciesBind::where('document_affiliate', trim($number_document))->first();

        if($client == null && $company == null && ($bind == null || $forceDelete)){
            // dump($number_document);
            datosPersonaesModel::where('n_cedula', trim($number_document))->delete();
            User::where('email', trim($number_document))->delete();
        }

            
    }

    public function createUser($store){
        $User              = new User;
        $User->email       = $store->document_affiliate;
        $User->password    = md5($store->document_affiliate);
        $User->img_profile = null;
        $User->id_rol      = 21;
        $User->save();


        $datos_personales                   = new datosPersonaesModel;
        $datos_personales->nombres          = $store->name_affiliate;
        $datos_personales->apellido_p       = null;
        $datos_personales->apellido_m       = null;
        $datos_personales->n_cedula         = $store->document_affiliate;
        $datos_personales->fecha_nacimiento = null;
        $datos_personales->telefono         = null;
        $datos_personales->direccion        = null;
        $datos_personales->id_usuario       = $User->id;
        $datos_personales->save();


        $auditoria              = new Auditoria;
        $auditoria->tabla       = "users";
        $auditoria->cod_reg     = $User->id;
        $auditoria->status      = 1;
        $auditoria->usr_regins  = 1;
        $auditoria->save();
    }
}
