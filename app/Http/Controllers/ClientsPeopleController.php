<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\Files;
use App\ClientsPeople;
use App\ClientsPeopleContact;
use App\ClientsPeopleInfoCrm;
use App\ClientsPeopleVehicle;
use App\ClientsPeopleChildrens;
use App\ClientsNotifications;
use App\ClientsWorkingInformation;

use App\Policies;
use App\PoliciesAnnexes;
use App\ChargeAccount;
use App\ChargeManagement;
use App\Departamentos;
use App\Municipios;
use Illuminate\Http\Request;

use App\User;
use App\datosPersonaesModel;
use App\PoliciesBind;
use App\ClientsCompany;


class ClientsPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = ClientsPeople::select("clients_people.*", "clients_people_contact.*", "clients_people_info_crm.*", "clients_notifications.*", "clients_people_working_information.*","auditoria.*", "user_registro.email as email_regis")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("clients_people_info_crm", "clients_people_info_crm.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("clients_notifications", "clients_notifications.id_clients", "=", "clients_people.id_clients_people")
                                ->join("clients_people_working_information", "clients_people_working_information.id_clients_people", "=", "clients_people.id_clients_people")

                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_people.id_clients_people")
                                ->where("auditoria.tabla", "clients_people")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("childrens")
                                ->with("vehicle")                               
                                
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_people.id_clients_people", "DESC")
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
            isset($request["own_house"])      ? $request["own_house"]       = 1 : $request["own_house"]      = 0;

            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;
            isset($request["send_birthday_card"])               ? $request["send_birthday_card"]               = 1 : $request["send_birthday_card"]              = 0;

            $store = ClientsPeople::create($request->all());


            $request["id_clients_people"] = $store["id_clients_people"];
            $request["id_clients"]        = $store["id_clients_people"];


            $store_clients_people               = ClientsPeopleContact::create($request->all());
            $store_clients_people_info_crm      = ClientsPeopleInfoCrm::create($request->all());
            $store_clients_notification         = ClientsNotifications::create($request->all());
            $store_clients_working_informations = ClientsWorkingInformation::create($request->all());

            $this->StoreChildren($request->all(), $store["id_clients_people"]);
            $this->StoreVehicle($request->all(), $store["id_clients_people"]);

            if(
               User::where('email', $store->number_document)->first() == null 
                && 
               ($store->number_document != null && $store->number_document != '')
             ){

               $this->createUser($store);
            }


            $destinationPath        = 'img/clients/peopple';
            $request["tabla"]       = "clients_people";
            $request["id_register"] = $store["id_clients_people"];

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
            $auditoria->tabla       = "clients_people";
            $auditoria->cod_reg     = $store["id_clients_people"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }

    public function updatedUser($number_document, $update){

        // Se busca en clientes, company y policie_bind si el numero de documento anterior existe
        // Si no existe ningun registro con el numero de documento, entonces se puede eliminar el usuario

        if($number_document != $update->number_document){

            $this->checkDestroyUser($number_document);
            
            $this->createUser($update);
        }


    }

    public function checkDestroyUser($number_document, $forceDelete = false){

        $client = ClientsPeople::where('number_document', trim($number_document))->first();
        $company = ClientsCompany::where('nit', trim($number_document))->first();
        $bind = PoliciesBind::where('document_affiliate', trim($number_document))->first();
        
        if(($client == null || $forceDelete) && $company == null && $bind == null){
            datosPersonaesModel::where('n_cedula', trim($number_document))->delete();
            User::where('email', trim($number_document))->delete();
        }
            
    }

    public function createUser($store){
        $User              = new User;
        $User->email       = $store->number_document;
        $User->password    = md5($store->number_document);
        $User->img_profile = null;
        $User->id_rol      = 21;
        $User->save();


        $datos_personales                   = new datosPersonaesModel;
        $datos_personales->nombres          = $store->names;
        $datos_personales->apellido_p       = $store->last_names;
        $datos_personales->apellido_m       = null;
        $datos_personales->n_cedula         = $store->number_document;
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


    public function  StoreChildren($data, $id_client_people){
        
        if(isset($data["name_children"])){
            foreach($data["name_children"] as $key => $value){
               $store = array();
               $store["id_clients_people"] = $id_client_people;
               $store["name"]              = $value;
               $store["phone"]             = $data["phone_children"][$key];
               $store["birthdate"]         = $data["birthdate_children"][$key];

               $store_children = ClientsPeopleChildrens::create($store);
            }
        }
    }


    public function  StoreVehicle($data, $id_client_people){
        
        if(isset($data["placa_vehicle"])){
            foreach($data["placa_vehicle"] as $key => $value){
               $store = array();
               $store["id_clients_people"]  = $id_client_people;
               $store["placa"]              = $value;
               $store["date_soat"]          = $data["date_soat"][$key];
               $store["date_taxes"]         = $data["date_taxes"][$key];
               $store["date_tecno"]         = $data["date_tecno"][$key];

               $store_children = ClientsPeopleVehicle::create($store);
            }
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientsPeople  $clientsPeople
     * @return \Illuminate\Http\Response
     */
    public function show($clientsPeople)
    {
        
        $modulos = ClientsPeople::select("clients_people.*", "clients_people_contact.*", "clients_people_info_crm.*", "clients_notifications.*", "clients_people_working_information.*","auditoria.*", "user_registro.email as email_regis")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("clients_people_info_crm", "clients_people_info_crm.id_clients_people", "=", "clients_people.id_clients_people")
                                ->join("clients_notifications", "clients_notifications.id_clients", "=", "clients_people.id_clients_people")
                                ->join("clients_people_working_information", "clients_people_working_information.id_clients_people", "=", "clients_people.id_clients_people")

                                ->join("auditoria", "auditoria.cod_reg", "=", "clients_people.id_clients_people")
                                ->where("auditoria.tabla", "clients_people")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("childrens")
                                ->with("vehicle")                               
                                
                                ->where("clients_people.id_clients_people", $clientsPeople)
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("clients_people.id_clients_people", "DESC")
                                ->get();
           

        return response()->json($modulos[0])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientsPeople  $clientsPeople
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsPeople $clientsPeople)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientsPeople  $clientsPeople
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientsPeople)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            

            isset($request["data_treatment"]) ? $request["data_treatment"]  = 1 : $request["data_treatment"] = 0;
            isset($request["own_house"])      ? $request["own_house"]       = 1 : $request["own_house"]      = 0;

            isset($request["send_policies_for_expire_email"])   ? $request["send_policies_for_expire_email"]   = 1 : $request["send_policies_for_expire_email"]  = 0;
            isset($request["send_portfolio_for_expire_email"])  ? $request["send_portfolio_for_expire_email"]  = 1 : $request["send_portfolio_for_expire_email"] = 0;
            isset($request["send_policies_for_expire_sms"])     ? $request["send_policies_for_expire_sms"]     = 1 : $request["send_policies_for_expire_sms"]    = 0;
            isset($request["send_portfolio_for_expire_sms"])    ? $request["send_portfolio_for_expire_sms"]    = 1 : $request["send_portfolio_for_expire_sms"]   = 0;
            isset($request["send_birthday_card"])               ? $request["send_birthday_card"]               = 1 : $request["send_birthday_card"]              = 0;


           $update = ClientsPeople::find($clientsPeople);
           $originalDocument = $update->number_document; 
           $update->update($request->all());

           // si es diferente, entonces se cambio el numero de doc

            $this->updatedUser($originalDocument, $update);

           ClientsPeopleContact::find($clientsPeople)->update($request->all());
           ClientsPeopleInfoCrm::find($clientsPeople)->update($request->all());
           ClientsNotifications::find($clientsPeople)->update($request->all());
           ClientsWorkingInformation::find($clientsPeople)->update($request->all());

           ClientsPeopleChildrens::where('id_clients_people', $clientsPeople)->delete();
           $this->StoreChildren($request->all(), $clientsPeople);

           ClientsPeopleVehicle::where('id_clients_people', $clientsPeople)->delete();
           $this->StoreVehicle($request->all(), $clientsPeople);

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
                                    ->where("tabla", "clients_people")->first();

        $auditoria->status = $status;

        if($status == 0){
            $auditoria->usr_regmod = $request["id_user"];
            $auditoria->fec_regmod = date("Y-m-d");

            $bind = ClientsPeople::find($id);

            $this->checkDestroyUser($bind->number_document, true);

        }
        $auditoria->save();

        $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
        return response()->json($data)->setStatusCode(200);
        
    }


    public function GetFiles(Request $request,  $id_client){
        
        $files = Files::select("files.*","auditoria.*", "user_registro.email as email_regis")

                        ->join("auditoria", "auditoria.cod_reg", "=", "files.id_files")
                        ->where("auditoria.tabla", "files")
                        ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                        
                        ->where("files.id_register", $id_client)
                        ->where("files.tabla", "clients_people")
                        ->where("auditoria.status", "!=", "0")
                        ->orderBy("files.id_files", "DESC")
                        ->get();
           
        return response()->json($files)->setStatusCode(200);
    }


    public function Policies($id_client, $type_cliente = 0){

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

                                ->where("policies.clients", $id_client)
                                ->where("policies.type_clients", $type_cliente)

                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)
                                ->orderBy("policies.id_policies", "DESC")
                                ->get();
           
        return response()->json($data)->setStatusCode(200);
    }




    public function Annexes($id_client, $type_cliente = 0){

        $data = PoliciesAnnexes::select("policies_annexes.*", "auditoria.*", "user_registro.email as email_regis")

                                            ->join("auditoria", "auditoria.cod_reg", "=", "policies_annexes.id_policies_annexes")
                                            ->where("auditoria.tabla", "policies_annexes")
                                            ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                            ->join("policies", "policies.id_policies", "=", "policies_annexes.id_policie")


                                            ->where("policies.clients", $id_client)
                                            ->where("policies.type_clients", $type_cliente)

                                            ->where("auditoria.status", "!=", "0")
                                            ->orderBy("auditoria.fec_regins", "DESC")
                                            ->get();
           
        return response()->json($data)->setStatusCode(200);
    }


    public function Wallet($id_client, $type_cliente = 0){
        $data = ChargeManagement::select("charge_accounts_management.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts_management.id")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->where("auditoria.tabla", "charge_accounts_management")
                                ->where("auditoria.status", "!=", "0")
                                
                                ->where("charge_accounts_management.id_client", $id_client)
                                ->where("charge_accounts_management.type_client", $type_cliente)

                                ->with('chargeAccount')

                                ->orderBy("charge_accounts_management.id", "DESC")
                                ->get();
           
        return response()->json($data)->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientsPeople  $clientsPeople
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsPeople $clientsPeople)
    {
        //
    }


    public function UpdateLocation(){
        $data = ClientsPeopleContact::get();

       // 
      //  echo \json_encode($departamentos);
        foreach($data as $client){
            
            $departamentos = Departamentos::where("nombre", $client["department"])->first();
            $municipios    = Municipios::where("nombre", $client["city"])->first();

            ClientsPeopleContact::where("id_clients_people_contact", $client["id_clients_people_contact"])->update(["id_department" => $departamentos["id"], "id_city" => $departamentos["id"]]);
         //   echo \json_encode($client["id_clients_people_contact"])."<br>";
           // echo \json_encode($departamentos["id"])."<br><br>";
           echo \json_encode($municipios["nombre"])."<br><br>";
        }
    }



    
}
