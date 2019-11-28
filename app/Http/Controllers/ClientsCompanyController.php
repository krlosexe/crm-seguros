<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ClientsCompany;
use App\ClientsNotifications;
use App\ClientsNotificacionsCompany;
use App\ClientsCompanyContact;
use Illuminate\Http\Request;

class ClientsCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = ClientsCompany::select("clients_company.*", "clients_company_contact.*", "clients_notifications.*","auditoria.*", "user_registro.email as email_regis")
                                ->join("clients_company_contact", "clients_company_contact.id_clients_company", "=", "clients_company.id_clients_company")
                               
                                ->join("clients_notifications", "clients_notifications.id_clients_company", "=", "clients_company.id_clients_company")
                                

                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_company.id_clients_company")
                                ->where("auditoria.tabla", "clients_company")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_company.id_clients_company", "DESC")
                                ->get();
           
        return response()->json($modulos)->setStatusCode(200);
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
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            isset($request["data_treatment"]) ? $request["data_treatment"]  = 1 : $request["data_treatment"] = 0;

            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;
            isset($request["send_birthday_card"])               ? $request["send_birthday_card"]               = 1 : $request["send_birthday_card"]              = 0;

            $store = ClientsCompany::create($request->all());


             $request["id_clients_company"]  = $store["id_clients_company"];
             $request["id_clients_company"]  = $store["id_clients_company"];


             $store_clients_company       = ClientsCompanyContact::create($request->all());
             $store_clients_notification  = ClientsNotifications::create($request->all());
        

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "clients_company";
            $auditoria->cod_reg     = $store["id_clients_company"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientsCompany  $clientsCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsCompany $clientsCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientsCompany  $clientsCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsCompany $clientsCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientsCompany  $clientsCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientsCompany)
    {

        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            isset($request["data_treatment"]) ? $request["data_treatment"]  = 1 : $request["data_treatment"] = 0;

            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;
            isset($request["send_birthday_card"])               ? $request["send_birthday_card"]               = 1 : $request["send_birthday_card"]              = 0;


            $update = ClientsCompany               :: find($clientsCompany)->update($request->all());
                      ClientsCompanyContact        :: find($clientsCompany)->update($request->all());
                      ClientsNotificacionsCompany  :: find($clientsCompany)->update($request->all());

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





    public function status($id, $status, Request $request)
    {
       
        $auditoria =  Auditoria::where("cod_reg", $id)
                                    ->where("tabla", "clients_company")->first();

        $auditoria->status = $status;

        if($status == 0){
            $auditoria->usr_regmod = $request["id_user"];
            $auditoria->fec_regmod = date("Y-m-d");
        }
        $auditoria->save();

        $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
        return response()->json($data)->setStatusCode(200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientsCompany  $clientsCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsCompany $clientsCompany)
    {
        //
    }
}
