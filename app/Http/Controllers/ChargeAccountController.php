<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ChargeAccount;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id_policie)
    {
        $modulos = ChargeAccount::select("charge_accounts.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChargeAccount  $chargeAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChargeAccount $chargeAccount)
    {
       
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
