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
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource........
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Policies::select("policies.*", "policies_info_taker_insured_beneficiary.*", "clients_people.names", "clients_people.last_names", 
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

                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("policies.id_policies", "DESC")
                                ->get();
           
        return response()->json($modulos)->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource............
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
            }else{
                
                foreach($request["number_annexed_bind"] as $key => $value){
                
                    $data["number_annexed"]             = $request["number_annexed_bind"][$key];
                    $data["number_affiliate"]           = $request["number_affiliate_bind"][$key];
                    $data["date_init"]                  = $request["date_init_bind"][$key];
                    $data["insured_object"]             = $request["insured_object_bind"][$key];
                    $data["cousin"]                     = str_replace(',', '', $request["cousin_bind"])[$key];
                    $data["name_affiliate"]             = $request["name_affiliate_bind"][$key];
                    $data["document_affiliate"]         = $request["document_affiliate_bind"][$key];
                    $data["relationship"]               = $request["relationship_bind"][$key];
                    $data["birthdate"]                  = $request["birthdate_bind"][$key];
                    $data["gender"]                     = $request["gender_bind"][$key];
                    $data["phone"]                      = $request["phone_bind"][$key];
                    $data["email"]                      = $request["email_bind"][$key];
                    $data["address"]                    = $request["address_bind"][$key];
                    $data["plan"]                       = $request["plan_bind"][$key];
                    $data["type_rate"]                  = $request["type_rate_bind"][$key];
                    $data["type_membership"]            = $request["type_membership_bind"][$key];
                    $data["percentage_vat"]             = str_replace(',', '', $request["percentage_vat_bind"])[$key];
                    $data["expenses"]                   = str_replace(',', '', $request["expenses_bind"])[$key];
                    $data["vat"]                        = str_replace(',', '', $request["vat_bind"])[$key];
                    $data["total"]                      = str_replace(',', '', $request["total_bind"])[$key];
                    $data["company"]                    = $request["company_bind"][$key];
                    $data["employee"]                   = $request["employee_bind"][$key];
                    $data["internal_observations"]      = $request["internal_observations_bind"][$key];
                    $data["observations"]               = $request["observations_bind"][$key];
                    $data["beneficairy_onerous"]        = $request["beneficairy_onerous_bind"][$key];
                    $data["beneficairy_name"]           = $request["beneficairy_name_bind"][$key];
                    $data["beneficairy_identification"] = $request["beneficairy_identification_bind"][$key];
                    $data["id_policie"]                 = $store->id_policies;

                    PoliciesBind::create($data);
                    
                }
           }
            

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
    public function show(Policies $policies)
    {
        //
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
            PoliciesCousinsCommissions::find($policies)->update($request->all());
            PoliciesNotifications::find($policies)->update($request->all());
            PoliciesInfoPayments::find($policies)->update($request->all());

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policies $policies)
    {
        //
    }
}
