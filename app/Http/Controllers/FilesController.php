<?php

namespace App\Http\Controllers;

use App\Files;
use App\Auditoria;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetFiles(Request $request,  $tabla, $id_client){
        
        $files = Files::select("files.*","auditoria.*", "user_registro.email as email_regis")

                        ->join("auditoria", "auditoria.cod_reg", "=", "files.id_files")
                        ->where("auditoria.tabla", "files")
                        ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                        
                        ->where("files.id_register", $id_client)
                        ->where("files.tabla", $tabla)
                        ->where("auditoria.status", "!=", "0")
                        ->orderBy("files.id_files", "DESC")
                        ->get();
           
        return response()->json($files)->setStatusCode(200);
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

            $destinationPath        = 'img/clients/peopple';

            $file = $request->file('file');
            $file->move($destinationPath,$file->getClientOriginalName());
    
            $request["name"] = $file->getClientOriginalName();

            $store_file = Files::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "files";
            $auditoria->cod_reg     = $store_file["id_files"];
            $auditoria->status      = 1;
            $auditoria->usr_regins  = $request["id_user"];
            $auditoria->save();

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }




    public function status($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "files")->first();

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
     * Display the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(Files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function edit(Files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $files)
    {


        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $destinationPath  = 'img/clients/peopple';
            $file = $request->file('file');
           
            if($file != null){
                $file->move($destinationPath,$file->getClientOriginalName());
                $request["name"] = $file->getClientOriginalName();
            }

            $update = Files::find($files)->update($request->all());

            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files)
    {
        //
    }
}
