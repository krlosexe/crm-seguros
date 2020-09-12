<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ClientsCompany;
use App\ClientsNotifications;
use App\ClientsNotificacionsCompany;
use App\ClientsCompanyContact;
use Illuminate\Http\Request;


use App\User;
use App\datosPersonaesModel;
use App\PoliciesBind;
use App\ClientsPeople;


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

            if(
               User::where('email', $store->nit)->first() == null 
                && 
               ($store->nit != null && $store->nit != '')
             ){

               $this->createUser($store);
            }


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

            
            $update = ClientsCompany::find($clientsCompany);
            $originalNit = $update->nit;
            $update->update($request->all());

            $this->updatedUser($originalNit, $update);

              ClientsCompanyContact::find($clientsCompany)->update($request->all());
              ClientsNotificacionsCompany::find($clientsCompany)->update($request->all());

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

            $bind = ClientsCompany::find($id);

            $this->checkDestroyUser($bind->nit, true);
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


    public function updatedUser($number_document, $update){

        // Se busca en clientes, company y policie_bind si el numero de documento anterior existe
        // Si no existe ningun registro con el numero de documento, entonces se puede eliminar el usuario

        if($number_document != $update->nit){

            $this->checkDestroyUser($number_document);
            
            $this->createUser($update);
        }


    }

    public function checkDestroyUser($number_document, $forceDelete = false){

        $client = ClientsPeople::where('number_document', trim($number_document))->first();
        $company = ClientsCompany::where('nit', trim($number_document))->first();
        $bind = PoliciesBind::where('document_affiliate', trim($number_document))->first();

        if($client == null && $bind == null && ($company == null || $forceDelete)){
            datosPersonaesModel::where('n_cedula', trim($number_document))->delete();
            User::where('email', trim($number_document))->delete();
        }
            
    }

    public function createUser($store){
        $User              = new User;
        $User->email       = $store->nit;
        $User->password    = md5($store->nit);
        $User->img_profile = null;
        $User->id_rol      = 21;
        $User->save();


        $datos_personales                   = new datosPersonaesModel;
        $datos_personales->nombres          = $store->business_name;
        $datos_personales->apellido_p       = '';
        $datos_personales->apellido_m       = null;
        $datos_personales->n_cedula         = $store->nit;
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
