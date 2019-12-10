<?php

namespace App\Http\Controllers;

use App\Policies;
use App\Auditoria;
use App\PoliciesInfoTakerInsuredBeneficiary;
use App\PoliciesObservations;
use App\PoliciesCousinsCommissions;
use App\PoliciesNotifications;
use App\PoliciesInfoPayments;
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
        $modulos = Policies::select("policies.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                                ->where("auditoria.tabla", "policies")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            PoliciesCousinsCommissions::create($request->all());
            PoliciesNotifications::create($request->all());
            PoliciesInfoPayments::create($request->all());

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policies $policies)
    {
        //
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
