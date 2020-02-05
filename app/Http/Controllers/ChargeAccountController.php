<?php

namespace App\Http\Controllers;

use App\Auditoria;
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


            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);


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

    /**
    
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id_policie)
    {
        $modulos = ChargeAccount::select("charge_accounts.*", "policies.number_policies","policies_annexes.number_annexed", "auditoria.*", "user_registro.email as email_regis")
                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")

                                ->with("collections")
                                
                                ->where("charge_accounts.id_policie", $id_policie)
                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->get();
           
            return response()->json($modulos)->setStatusCode(200);
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

    /**
     * Update the specified resource in storage.
     
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chargeAccount)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){


            $request["cousin"]                = (float) str_replace(',', '', $request["cousin"]);
            $request["xpenses"]               = (float) str_replace(',', '', $request["xpenses"]);
            $request["vat"]                   = (float) str_replace(',', '', $request["vat"]);
            $request["percentage_vat_cousin"] = (float) str_replace(',', '', $request["percentage_vat_cousin"]);
            $request["commission_percentage"] = (float) str_replace(',', '', $request["commission_percentage"]);
            $request["agency_commission"]     = (float) str_replace(',', '', $request["agency_commission"]);
            $request["total"]                 = (float) str_replace(',', '', $request["total"]);

            
            $update = ChargeAccount::find($chargeAccount)->update($request->all());

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
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "charge_accounts")->first();

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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(ChargeAccount $chargeAccount)
    {
        //
    }
}
