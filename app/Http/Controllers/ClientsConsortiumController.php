<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\ClientsConsortium;
use App\ConsortiumPartners;
use Illuminate\Http\Request;

class ClientsConsortiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = ClientsConsortium::select("clients_consortium.*", "auditoria.*", "user_registro.email as email_regis")
                                        ->join("auditoria", "auditoria.cod_reg", "=", "clients_consortium.id_clients_consortium")
                                        ->where("auditoria.tabla", "consortium")
                                        ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                        ->with('partnersPeople')
                                        ->with('partnersCompany')

                                        ->where("auditoria.status", "!=", "0")
                                        ->orderBy("clients_consortium.id_clients_consortium", "DESC")
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

            $store = ClientsConsortium::create($request->all());



            foreach($request["id_client"] as $key => $value){
                
                $request["id_client_people"]  = null;
                $request["id_client_company"] = null;
                
                if($request["type_client"][$key] == 0){
                    $request["id_client_people"] = $value;
                }else{
                    $request["id_client_company"] = $value;
                }
                $request["id_clients_consortium"] = $store["id_clients_consortium"];
                ConsortiumPartners::create($request->all());
            }


            $auditoria              = new Auditoria;
            $auditoria->tabla       = "consortium";
            $auditoria->cod_reg     = $store["id_clients_consortium"];
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
     * @param  \App\ClientsConsortium  $clientsConsortium
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsConsortium $clientsConsortium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientsConsortium  $clientsConsortium
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsConsortium $clientsConsortium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientsConsortium  $clientsConsortium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientsConsortium)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            $update = ClientsConsortium::find($clientsConsortium)->update($request->all());
            ConsortiumPartners::where('id_clients_consortium', $clientsConsortium)->delete();


            foreach($request["id_client"] as $key => $value){
                $request["id_client_people"]  = null;
                $request["id_client_company"] = null;
                
                if($request["type_client"][$key] == 0){
                    $request["id_client_people"] = $value;
                }else{
                    $request["id_client_company"] = $value;
                }
                $request["id_clients_consortium"] = $clientsConsortium;
                ConsortiumPartners::create($request->all());
            }




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
                                    ->where("tabla", "consortium")->first();

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
     * @param  \App\ClientsConsortium  $clientsConsortium
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsConsortium $clientsConsortium)
    {
        //
    }
}
