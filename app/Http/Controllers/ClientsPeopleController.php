<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ClientsPeople;
use App\ClientsPeopleContact;
use App\ClientsPeopleInfoCrm;
use App\ClientsPeopleVehicle;
use App\ClientsPeopleChildrens;
use App\ClientsNotifications;
use App\ClientsWorkingInformation;
use Illuminate\Http\Request;

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
    public function show(ClientsPeople $clientsPeople)
    {
        //
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


            $update = ClientsPeople::find($clientsPeople)->update($request->all());
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
        }
        $auditoria->save();

        $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
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
}
