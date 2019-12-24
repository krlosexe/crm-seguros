<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\PoliciesGrouped;
use Illuminate\Http\Request;

class PoliciesGroupedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = PoliciesGrouped::select("policies_grouped.*", "insurers.name as name_insurers", "branchs.name as name_branchs",
                                            "auditoria.*", "user_registro.email as email_regis")

                                            ->join("insurers", "insurers.id_insurers", "=", "policies_grouped.insurers")
                                            ->join("branchs", "branchs.id_branchs", "=", "policies_grouped.branch")
                                
                                            ->join("auditoria", "auditoria.cod_reg", "=", "policies_grouped.id_policies_grouped")
                                            ->where("auditoria.tabla", "policies_grouped")
                                            ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                            ->where("auditoria.status", "!=", "0")
                                            ->orderBy("policies_grouped.id_policies_grouped", "DESC")
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
            

            isset($request["is_renewable"])  ? $request["is_renewable"] = 1 : $request["is_renewable"] = 0;
            
            $store                  = PoliciesGrouped::create($request->all());
        
            $auditoria              = new Auditoria;
            $auditoria->tabla       = "policies_grouped";
            $auditoria->cod_reg     = $store->id_policies_grouped;
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
     * @param  \App\PoliciesGrouped  $policiesGrouped
     * @return \Illuminate\Http\Response
     */
    public function show(PoliciesGrouped $policiesGrouped)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PoliciesGrouped  $policiesGrouped
     * @return \Illuminate\Http\Response
     */
    public function edit(PoliciesGrouped $policiesGrouped)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PoliciesGrouped  $policiesGrouped
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $policies)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            isset($request["is_renewable"]) ? $request["is_renewable"] = 1 : $request["is_renewable"] = 0;
            
            $update = PoliciesGrouped::find($policies)->update($request->all());

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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PoliciesGrouped  $policiesGrouped
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoliciesGrouped $policiesGrouped)
    {
        //
    }
}
