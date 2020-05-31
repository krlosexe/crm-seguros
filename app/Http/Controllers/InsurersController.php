<?php

namespace App\Http\Controllers;

use App\Insurers;
use App\Auditoria;
use App\InsurersOficce;
use App\InsurersBranchs;
use App\InsurersSubCompany;
use Illuminate\Http\Request;

class InsurersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $data = Insurers::select("insurers.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "insurers.id_insurers")
                                ->where("auditoria.tabla", "insurers")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("Branchs")

                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("insurers.id_insurers", "DESC")
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
            

            $store                   = Insurers::create($request->all());
            $request["id_insurers"]  = $store->id_insurers;

           if(isset($request["id_branch"])){
                foreach($request["id_branch"] as $key => $value){

                    $request["id_branch"]             = $value;
                    $request["code"]                  = $request["codes"][$key];
                    $request["commission_percentage"] = $request["commission_percentages"][$key];
                    $request["vat_percentage"]        = $request["vat_percentages"][$key];

                    InsurersBranchs::create($request->all());
                }
           }        
            

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "insurers";
            $auditoria->cod_reg     = $store->id_insurers;
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
     * @param  \App\Insurers  $insurers
     * @return \Illuminate\Http\Response
     */
    public function show($insurers)
    {
        $modulos = Insurers::select("insurers.*", "auditoria.*", "user_registro.email as email_regis")
                                ->join("auditoria", "auditoria.cod_reg", "=", "insurers.id_insurers")
                                ->where("auditoria.tabla", "insurers")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->with("Branchs")

                                ->where("auditoria.status", "!=", "0")
                                ->where("insurers.id_insurers", $insurers)
                                ->orderBy("insurers.id_insurers", "DESC")
                                ->get();
           
        return response()->json($modulos[0])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insurers  $insurers
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurers $insurers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insurers  $insurers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $insurers)
    {

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $update = Insurers::find($insurers)->update($request->all());

            InsurersBranchs::where('id_insurers', $insurers)->delete();

            $request["id_insurers"]  = $insurers;

            if(isset($request["id_branch"])){
                foreach($request["id_branch"] as $key => $value){

                    $request["id_branch"]             = $value;
                    $request["code"]                  = $request["codes"][$key];
                    $request["commission_percentage"] = $request["commission_percentages"][$key];
                    $request["vat_percentage"]        = $request["vat_percentages"][$key];

                    InsurersBranchs::create($request->all());
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
                                     ->where("tabla", "insurers")->first();

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




    public function StoreSubCompany(request $request){


        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            isset($request["turn_check"])         ? $request["turn_check"] = 1        : $request["turn_check"]        = 0;
            isset($request["court_of_accounts"])  ? $request["court_of_accounts"] = 1 : $request["court_of_accounts"] = 0;
            isset($request["ica"])                ? $request["ica"] = 1               : $request["ica"]               = 0;

            $store                  = InsurersSubCompany::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "insurers_sub_company";
            $auditoria->cod_reg     = $store->id_insurers_sub_company;
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

    public function GetSubCompany(request $request, $insurers){

        $data = InsurersSubCompany::select("insurers_sub_company.*", "auditoria.*", "user_registro.email as email_regis")
                                    ->join("auditoria", "auditoria.cod_reg", "=", "insurers_sub_company.id_insurers_sub_company")
                                    ->where("auditoria.tabla", "insurers_sub_company")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                    ->where("insurers_sub_company.id_surgerie", $insurers)

                                    ->where("auditoria.status", "!=", "0")
                                    ->orderBy("insurers_sub_company.id_insurers_sub_company", "DESC")
                                    ->get();
           
        return response()->json($data)->setStatusCode(200);

    }



    public function updateSubCompany(Request $request,  $id)
    {   
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            isset($request["turn_check"])         ? $request["turn_check"] = 1        : $request["turn_check"]        = 0;
            isset($request["court_of_accounts"])  ? $request["court_of_accounts"] = 1 : $request["court_of_accounts"] = 0;
            isset($request["ica"])                ? $request["ica"] = 1               : $request["ica"]               = 0;

            $update = InsurersSubCompany::find($id)->update($request->all());

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



    function statusSubCompany($id, $status, Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "insurers_sub_company")->first();

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



    public function StoreOficce(request $request){


        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            isset($request["headquarters_default"]) ? $request["headquarters_default"] = 1  : $request["headquarters_default"] = 0;

            $store                  = InsurersOficce::create($request->all());

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "insurers_oficce";
            $auditoria->cod_reg     = $store->id_insurers_oficce;
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

    

    public function getOficce(request $request, $insurers){

        $data = InsurersOficce::select("insurers_oficce.*", "auditoria.*", "user_registro.email as email_regis")
                                    ->join("auditoria", "auditoria.cod_reg", "=", "insurers_oficce.id_insurers_oficce")
                                    ->where("auditoria.tabla", "insurers_oficce")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                    ->where("insurers_oficce.id_surgerie", $insurers)

                                    ->where("auditoria.status", "!=", "0")
                                    ->orderBy("insurers_oficce.id_insurers_oficce", "DESC")
                                    ->get();
           
        return response()->json($data)->setStatusCode(200);

    }




    public function updateOficce(Request $request,  $id)
    {   
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            isset($request["headquarters_default"]) ? $request["headquarters_default"] = 1  : $request["headquarters_default"] = 0;

            $update = InsurersOficce::find($id)->update($request->all());

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



    function statusOficce($id, $status, Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "insurers_oficce")->first();

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
     * @param  \App\Insurers  $insurers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurers $insurers)
    {
        //
    }
}
