<?php

namespace App\Http\Controllers;

use App\Policies;
use App\PoliciesAnnexes;
use App\Auditoria;
use App\ChargeManagement;
use App\ChargeAccount;
use App\Collections;
use Illuminate\Http\Request;

class ChargeAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $request['id_policie'] = $request->number;

            if($request->policie_annexes == 'Poliza'){
                $policies = Policies::find($request->number);

                $request['id_client'] = $policies->clients;
                $request['type_client'] = $policies->type_clients;
                $request['number'] = $policies->number_policies;

            }
            else{
                $policies = PoliciesAnnexes::find($request->number);

                $request['id_client'] = $policies->policie->clients;
                $request['type_client'] = $policies->policie->type_clients;
                $request['number'] = $policies->number_annexed;

            }

            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);

            $storeManagement = ChargeManagement::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "charge_accounts_management";
            $auditoria->cod_reg     = $storeManagement["id"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            $request['management_id'] = $storeManagement['id'];

            $store = ChargeAccount::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "charge_accounts";
            $auditoria->cod_reg     = $store["id_charge_accounts"];
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

    public function storeMultiple(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $chargeManagement = $request->all();

            $chargeManagement['total'] = array_reduce($chargeManagement['total'], function($carry, $item){
                $carry += (float) str_replace(',', '', $item);
                return $carry;
            });


            $storeManagement = ChargeManagement::create($chargeManagement);
            
            $auditoria              = new Auditoria;
            $auditoria->tabla       = "charge_accounts_management";
            $auditoria->cod_reg     = $storeManagement->id;
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            foreach ($request->cousin as $key => $value) {
                $item = $request->all();

               if($request->policie_annexes == 'Poliza'){
                    $policies = Policies::find($item['id_policie'][$key]);
                    $item['number'] = $policies->number_policies;
                }
                else{
                    $policies = PoliciesAnnexes::find($item['id_policie'][$key]);

                    $item['number'] = $policies->number_annexed;
                }

                $item["id_policie"]            = $item['id_policie'][$key];
                $item["cousin"]                = (float) str_replace(',', '', $item["cousin"][$key]);
                $item["xpenses"]               = (float) str_replace(',', '', $item["xpenses"][$key]);
                $item["vat"]                   = (float) str_replace(',', '', $item["vat"][$key]);
                $item["percentage_vat_cousin"] = (float) str_replace(',', '', $item["percentage_vat_cousin"][$key]);
                $item["commission_percentage"] = (float) str_replace(',', '', $item["commission_percentage"][$key]);
                $item["agency_commission"]     = (float) str_replace(',', '', $item["agency_commission"][$key]);
                $item["total"]                 = (float) str_replace(',', '', $item["total"][$key]);
                $item['management_id']         = $storeManagement->id;
                $item["participation"]         = $item["participation"][$key];

                $store = ChargeAccount::create($item);

                $auditoria              = new Auditoria;
                $auditoria->tabla       = "charge_accounts";
                $auditoria->cod_reg     = $store["id_charge_accounts"];
                $auditoria->status      = 1;
                $auditoria->usr_regins  = $request["id_user"];
                $auditoria->save();

                if(!$store){
                    return response()->json("Ha ocurrido un error al guardar alguno de los registros, por favor revise los movimientos antes de continuar")->setStatusCode(400);
                    
                }
            }

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
    

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function updateMultiple(Request $request, $charge)
    {

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $chargeManagement = $request->all();

            $chargeManagement['total'] = array_reduce($chargeManagement['total'], function($carry, $item){
                $carry += (float) str_replace(',', '', $item);
                return $carry;
            });

            $storeManagement = ChargeManagement::find($charge)->update($chargeManagement);
            
            foreach ($request->cousin as $key => $value) {
                $item = $request->all();

               if($request->policie_annexes == 'Poliza'){
                    $policies = Policies::find($item['id_policie'][$key]);
                    $item['number'] = $policies->number_policies;
                }
                else{
                    $policies = PoliciesAnnexes::find($item['id_policie'][$key]);

                    $item['number'] = $policies->number_annexed;
                }

                $item["id_policie"]            = $item['id_policie'][$key];
                $item["cousin"]                = (float) str_replace(',', '', $item["cousin"][$key]);
                $item["xpenses"]               = (float) str_replace(',', '', $item["xpenses"][$key]);
                $item["vat"]                   = (float) str_replace(',', '', $item["vat"][$key]);
                $item["percentage_vat_cousin"] = (float) str_replace(',', '', $item["percentage_vat_cousin"][$key]);
                $item["commission_percentage"] = (float) str_replace(',', '', $item["commission_percentage"][$key]);
                $item["agency_commission"]     = (float) str_replace(',', '', $item["agency_commission"][$key]);
                $item["total"]                 = (float) str_replace(',', '', $item["total"][$key]);
                $item["participation"]         = $item["participation"][$key];
                $item['management_id']         = $charge;

                if($item['charge_account_id'][$key] == 0){
                    $store = ChargeAccount::create($item);

                    $auditoria              = new Auditoria;
                    $auditoria->tabla       = "charge_accounts";
                    $auditoria->cod_reg     = $store["id_charge_accounts"];
                    $auditoria->status      = 1;
                    $auditoria->usr_regins  = $request["id_user"];
                    $auditoria->save();
                }
                else{
                    $store = ChargeAccount::find($item['charge_account_id'][$key])->update($item);
                }

                if(!$store){
                    return response()->json("Ha ocurrido un error al guardar alguno de los registros, por favor revise los movimientos antes de continuar")->setStatusCode(400);
                    
                }
            }

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
    

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }


    /**
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id_policie)
    {
        
        $data = ChargeAccount::select("charge_accounts.*", "policies.number_policies","policies_annexes.number_annexed", "auditoria.*", "user_registro.email as email_regis")
                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")

                                ->with(["collections", "chargeManagement"])
                                
                                ->where("charge_accounts.id_policie", $id_policie)
                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->get()->toArray();

        $data2 = ChargeAccount::select("charge_accounts.*", "policies.number_policies","policies_annexes.number_annexed", "auditoria.*", "user_registro.email as email_regis")
                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.id_policie", "left")
                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")

                                ->with(["collections", "chargeManagement"])
                                
                                ->where("policies_annexes.id_policie", $id_policie)
                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->get()->toArray();

        $data = array_merge($data, $data2);

        return response()->json($data)->setStatusCode(200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ChargeAccount $chargeAccount)
    {


    }

    public function get($chargeAccount)
    {
        $data = ChargeAccount::select("charge_accounts.*","policies.type_clients", "policies.number_policies","policies_annexes.number_annexed", 
                                        "clients_people.names as name_client", "clients_people.last_names", "clients_people.number_document",
                                        "clients_people_contact.department","clients_people_contact.city", "branchs.name as name_branch",
                                        "clients_company_contact.department","clients_company_contact.city","datos_personales.*", 
                                        "auditoria.*", "user_registro.email as email_regis", "user_registro.firm", "clients_company.business_name", "clients_company.nit as number_document")

                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")

                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("clients_company_contact", "clients_company_contact.id_clients_company", "=", "clients_company.id_clients_company", "left")


                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people", "left")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch", "left")

                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->join('datos_personales', 'datos_personales.id_usuario', '=', 'user_registro.id')
                                ->where("auditoria.status", "!=", "0")

                                ->with("collections")
                                
                                ->where("charge_accounts.id_charge_accounts", $chargeAccount)
                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->first();
           
            return response()->json($data)->setStatusCode(200);

    }


    public function Expired(){
        $data = ChargeAccount::select("charge_accounts.*","policies.type_clients", "policies.number_policies","policies_annexes.number_annexed", 
                                        "clients_people.names as name_client", "clients_people.last_names", "clients_people.number_document",
                                        "clients_people_contact.department","clients_people_contact.city", "branchs.name as name_branch",
                                        "clients_company_contact.department","clients_company_contact.city","datos_personales.*", 
                                        "auditoria.*", "user_registro.email as email_regis", "user_registro.firm", "clients_company.business_name", "clients_company.nit as number_document")

                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")

                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("clients_company_contact", "clients_company_contact.id_clients_company", "=", "clients_company.id_clients_company", "left")


                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people", "left")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch", "left")

                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->join('datos_personales', 'datos_personales.id_usuario', '=', 'user_registro.id')
                                ->where("auditoria.status", "!=", "0")


                                ->join("auditoria as ap", "ap.cod_reg", "=", "policies.id_policies")
                                ->where("ap.tabla", "policies")

                                ->where("ap.status", "!=", "0")

                                ->with("collections")
                                
                                ->where("charge_accounts.limit_date", "<=", date("Y-m-d"))

                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->get();
           
            return response()->json($data)->setStatusCode(200);
    }



    /**
     * Update the specified resource in storage.
     
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chargeAccount)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            $chargeAccount = ChargeAccount::find($chargeAccount);

            $request['id_policie'] = $chargeAccount->id_policie;

            if($request->policie_annexes == 'Poliza'){
                $policies = Policies::find($chargeAccount->id_policie);
                $request['number'] = $policies->number_policies;

            }
            else{
                $policies = PoliciesAnnexes::find($chargeAccount->id_policie);

                $request['number'] = $policies->number_annexed;

            }


            $request->cousin                = (float) str_replace(',', '', $request["cousin"]);
            $request->participation         = $request["participation"];
            $request->xpenses               = (float) str_replace(',', '', $request["xpenses"]);
            $request->vat                   = (float) str_replace(',', '', $request["vat"]);
            $request->percentage_vat_cousin = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request->commission_percentage = (float) str_replace(',', '', $request["commission_percentage"]);
            $request->agency_commission     = (float) str_replace(',', '', $request["agency_commission"]);
            $request->total                 = (float) str_replace(',', '', $request["total"]);

            ChargeManagement::find($chargeAccount->management_id)->update($request->all());

            $update = $chargeAccount->update($request->all());


            if ($update) {
                $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }


    public function status($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $auditoria =  Auditoria::where("cod_reg", $id)->where("tabla", "charge_accounts_management")->first();
            
            $auditoria->status = $status;

            if($status == 0){
                $auditoria->usr_regmod = $request["id_user"];
                $auditoria->fec_regmod = date("Y-m-d");
            }

            $auditoria->save();

            $chargeManagement = ChargeManagement::find($id);

            $chargeAccounts = ChargeAccount::where('management_id', $chargeManagement->id)->get();
            
            foreach ($chargeAccounts as $charge) {

                $auditoriaDetalle =  Auditoria::where("cod_reg", $charge->id_charge_accounts)->where("tabla", "charge_accounts")->first();
                $auditoriaDetalle->status = $status;

                if($status == 0){
                    $auditoriaDetalle->usr_regmod = $request["id_user"];
                    $auditoriaDetalle->fec_regmod = date("Y-m-d");
                }

                $auditoriaDetalle->save();

            }

            $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function statusChangeAccount($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $auditoria =  Auditoria::where("cod_reg", $id)->where("tabla", "charge_accounts")->first();

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


    public function getCollection($id){
        $data = Collections::select("collections.*", "insurers.name as name_insurer", 
                                    "charge_accounts.*", "policies.number_policies","policies_annexes.number_annexed", "branchs.name as name_branch",
                                    "clients_people.names as name_client", "clients_people.last_names" , "clients_people_contact.department","clients_people_contact.city", 
                                    "auditoria.*"
                                )

                                ->join("charge_accounts", "charge_accounts.id_charge_accounts", "=", "collections.id_charge_accounts")
                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people", "left")

                                ->join("auditoria", "auditoria.cod_reg", "=", "collections.id_collections")

                                ->where("auditoria.tabla", "collections")
                                ->where("collections.id_collections", $id)
                                
                                ->first();
           
            return response()->json($data)->setStatusCode(200);
    }
    /**
     * Remove the specified resource from storage.
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChargeAccount $chargeAccount)
    {
        //
    }
}