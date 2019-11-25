<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ClientsPeople;
use App\ClientsPeopleContact;
use App\ClientsPeopleInfoCrm;
use App\ClientsPeopleChildrens;
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
        //
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

            $store = ClientsPeople::create($request->all());

            $request["id_clients_people"] = $store["id_clients_people"];

            $store_clients_people          = ClientsPeopleContact::create($request->all());
            $store_clients_people_info_crm = ClientsPeopleInfoCrm::create($request->all());

            $this->StoreChildren($request->all(), $store["id_clients_people"]);

            
            


            $auditoria              = new Auditoria;
            $auditoria->tabla       = "clients_people";
            $auditoria->cod_reg     = $store["id_clients_people"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            echo "STRING";

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }


    public function  StoreChildren($data, $id_client_people){
        
        if($data["name_children"] != null){
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
    public function update(Request $request, ClientsPeople $clientsPeople)
    {
        //
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
