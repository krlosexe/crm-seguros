<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\TypeSubCompany;
use Illuminate\Http\Request;

class TypeSubCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $modulos = TypeSubCompany::select("type_sub_company.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "type_sub_company.id_type_sub_company")
                                ->where("auditoria.tabla", "type_sub_company")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("type_sub_company.id_type_sub_company", "DESC")
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
          
            $store = TypeSubCompany::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "type_sub_company";
            $auditoria->cod_reg     = $store->id_type_sub_company;
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
     * @param  \App\TypeSubCompany  $typeSubCompany
     * @return \Illuminate\Http\Response
     */
    public function show(TypeSubCompany $typeSubCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeSubCompany  $typeSubCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeSubCompany $typeSubCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeSubCompany  $typeSubCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_sub_company)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $update = TypeSubCompany::find($type_sub_company)->update($request->all());

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
                                     ->where("tabla", "type_sub_company")->first();

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
     * @param  \App\TypeSubCompany  $typeSubCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeSubCompany $typeSubCompany)
    {
        //
    }
}
