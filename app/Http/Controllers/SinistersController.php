<?php

namespace App\Http\Controllers;

use App\Sinisters;
use App\Auditoria;
use App\SinisterAmparosAffected;
use Illuminate\Http\Request;

class SinistersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sinisters::select("sinisters.*", "policies.number_policies",  "auditoria.*", "user_registro.email as email_regis")

                                    ->join("policies", "policies.id_policies", "=", "sinisters.policie")

                                    ->join("auditoria", "auditoria.cod_reg", "=", "sinisters.id_sinister")
                                    ->where("auditoria.tabla", "sinisters")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                      ->with("sinister_amparos_affected")

                                    ->where("auditoria.status", "!=", "0")
                                    ->orderBy("sinisters.id_sinister", "DESC")
                                    ->get();
           
        return response()->json($data)->setStatusCode(200);
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
            
            
            isset($request["finalized"])  ? $request["finalized"]  = 1 : $request["finalized"] = 0;

            $store                   = Sinisters::create($request->all());
            $request["id_sinister"]  = $store->id_sinister;

            if(isset($request["name_claimant_sinister"])){
                foreach($request["name_claimant_sinister"] as $key => $value){

                    $request["name_claimant"]  = $value;
                    $request["amparo"]         = $request["amparo_sinister"][$key];
                    $request["value"]          = (float) str_replace(',', '', $request["value_sinister"][$key]);
                    SinisterAmparosAffected::create($request->all());
                }
           }        

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "sinisters";
            $auditoria->cod_reg     = $store->id_sinister;
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
     * @param  \App\Sinisters  $sinisters
     * @return \Illuminate\Http\Response
     */
    public function show(Sinisters $sinisters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sinisters  $sinisters
     * @return \Illuminate\Http\Response
     */
    public function edit(Sinisters $sinisters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sinisters  $sinisters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sinisters)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){


            isset($request["finalized"]) ? $request["finalized"] = 1 : $request["finalized"]  = 0;

            $request["id_sinister"]  = $sinisters;
            $update = Sinisters::find($sinisters)->update($request->all());

            SinisterAmparosAffected::where('id_sinister', $sinisters)->delete();

            if(isset($request["name_claimant_sinister"])){
                foreach($request["name_claimant_sinister"] as $key => $value){

                    $request["name_claimant"]  = $value;
                    $request["amparo"]         = $request["amparo_sinister"][$key];
                    $request["value"]          = (float) str_replace(',', '', $request["value_sinister"][$key]);
                    SinisterAmparosAffected::create($request->all());
                }
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
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "sinisters")->first();

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
     * @param  \App\Sinisters  $sinisters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sinisters $sinisters)
    {
        //
    }
}
