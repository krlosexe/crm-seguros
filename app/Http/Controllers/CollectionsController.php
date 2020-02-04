<?php

namespace App\Http\Controllers;

use App\Collections;
use App\Auditoria;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function store(Request $request){
       
        $destinationPath        = 'img/collections';
        $request["tabla"]       = "clients_people";

        if($request->file('file')){

            $file = $request->file('file');

            $file->move($destinationPath,$file->getClientOriginalName());
            $request["name"] = $file->getClientOriginalName();

            $store_file = Collections::create($request->all());


            $auditoria              = new Auditoria;
            $auditoria->tabla       = "collections";
            $auditoria->cod_reg     = $store_file["id_collections"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();
           
        }


        if ($store_file) {
            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("A ocurrido un error")->setStatusCode(400);
        }

    }



    public function update(Request $request, $id)
    {
        
            $destinationPath        = 'img/collections';
            $file = $request->file('file');
           
            if($file != null){
                $file->move($destinationPath,$file->getClientOriginalName());
                $request["name"] = $file->getClientOriginalName();
            }

            $update = Collections::find($id)->update($request->all());

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
    }





    public function get($id){
        $modulos = Collections::select("collections.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "collections.id_collections")
                                ->where("auditoria.tabla", "collections")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->where("auditoria.status", "!=", "0")
                                
                                ->where("collections.id_charge_accounts", $id)
                                ->orderBy("collections.id_collections", "DESC")
                                ->get();
           
            return response()->json($modulos)->setStatusCode(200);
    }



    public function status($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "collections")->first();

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




}
