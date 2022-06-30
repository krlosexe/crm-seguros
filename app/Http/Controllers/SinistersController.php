<?php

namespace App\Http\Controllers;

use App\Sinisters;
use App\Auditoria;
use App\SinisterAmparosAffected;
use Illuminate\Http\Request;
use DB;
class SinistersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $companie, $sinister, $branch, $rol)
    {

        $id_client = null;
        if($rol == 22){
            $user            = DB::table("users")->where("id", $request["id_user"])->first();
            $clients_company = DB::table("clients_company")->where("nit", $user->email)->first();
            $id_client = $clients_company->id_clients_company;
        }
      
        $data = Sinisters::select("sinisters.*", "policies.number_policies",  "auditoria.*", "user_registro.email as email_regis")

                                    ->join("policies", "policies.id_policies", "=", "sinisters.policie")

                                    ->join("auditoria", "auditoria.cod_reg", "=", "sinisters.id_sinister")
                                    ->where("auditoria.tabla", "sinisters")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                    ->with("sinister_amparos_affected")
                                    ->where(function ($query) use ($companie) {
                                        if($companie != "0"){
                                            $query->where("sinisters.id_client", $companie);
                                        }
                                    })

                                    ->where(function ($query) use ($sinister) {
                                        if($sinister != "0"){
                                            $query->whereRaw("sinisters.number_sinister like '%".$sinister."%'");
                                        }
                                    })

                                    ->where(function ($query) use ($branch) {
                                        if($branch != "0"){
                                            $query->where("sinisters.branch", $branch);
                                        }
                                    })


                                    ->where(function ($query) use ($rol, $id_client) {
                                        if($rol == 22){
                                            $query->where("sinisters.id_client", $id_client);
                                        }
                                    })


                                    ->where("auditoria.status", "!=", "0")
                                    ->orderBy("sinisters.id_sinister", "DESC")
                                    ->get();
           
        return response()->json($data)->setStatusCode(200);
    }



    public function GetByClient($id_client){


        $data = Sinisters::select("sinisters.*", "policies.number_policies",  "auditoria.*", "user_registro.email as email_regis")

                                    ->join("policies", "policies.id_policies", "=", "sinisters.policie")

                                    ->join("auditoria", "auditoria.cod_reg", "=", "sinisters.id_sinister")
                                    ->where("auditoria.tabla", "sinisters")
                                    ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                    ->with("sinister_amparos_affected")

                                    ->where("policies.clients", $id_client)
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


            
            if($request["comments"] != ""){
                DB::table("sinisters_comments")->insert([
                    "state"        => $request["state_policie"],
                    "comment"      => $request["comments"],
                    "id_sinister"  => $store->id_sinister,
                    "id_user"      => $request["id_user"]
                ]);
            }

            if($request->file('logo')){
                $file            = $request->file('logo');
                $destinationPath = 'img/sinisters';
                $file->move($destinationPath,$file->getClientOriginalName());
            
                DB::table("sinisters_files")->insert([
                    "state"        => $request["state_policie"],
                    "file"         => $file->getClientOriginalName(),
                    "id_sinister"  => $store->id_sinister,
                    "id_user"      => $request["id_user"]
                ]);
            }



            DB::table("sinisters_status")->insert([
                "status"       => $request["state_policie"],
                "fecha"        => $request["date_status"],
                "id_sinister"  => $store->id_sinister,
                "id_user"      => $request["id_user"]
            ]);


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



    public function getComments($state, $id){
       $data = DB::table("sinisters_comments")
                    ->select("sinisters_comments.*", "users.img_profile", "datos_personales.*")
                    ->join("users", "users.id", "=", "sinisters_comments.id_user")
                    ->join("datos_personales", "datos_personales.id_usuario", "=", "users.id")
                    ->where("sinisters_comments.state", $state)
                    ->where("sinisters_comments.id_sinister", $id)->get();
       return response()->json($data)->setStatusCode(200);
    }



    public function storeComments(Request $request){
        if($request["comment"] != ""){
            DB::table("sinisters_comments")->insert([
                "state"        => $request["state"],
                "comment"      => $request["comment"],
                "id_sinister"  => $request["id"],
                "id_user"      => $request["id_user"]
            ]);
        }

        return response()->json("ok")->setStatusCode(200);

    }



    public function getFiles($state, $id){
        $data = DB::table("sinisters_files")
                     ->where("sinisters_files.state", $state)
                     ->where("sinisters_files.id_sinister", $id)->get();
        return response()->json($data)->setStatusCode(200);
     }



     public function getStates($id){
        $data = DB::table("sinisters_status")
                     ->where("sinisters_status.id_sinister", $id)->get();
        return response()->json($data)->setStatusCode(200);
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


           

            $sinister = Sinisters::where("id_sinister",$sinisters)->first();


            if($sinister->state_policie != $request["state_policie"]){
                DB::table("sinisters_status")->insert([
                    "status"       => $request["state_policie"],
                    "fecha"        => $request["date_status"],
                    "id_sinister"  => $sinisters,
                    "id_user"      => $request["id_user"]
                ]);
            }


            if($request->file('logo')){
                $file            = $request->file('logo');
                $destinationPath = 'img/sinisters';
                $file->move($destinationPath,$file->getClientOriginalName());
            
                DB::table("sinisters_files")->insert([
                    "state"        => $request["state_policie"],
                    "file"         => $file->getClientOriginalName(),
                    "id_sinister"  => $sinisters,
                    "id_user"      => $request["id_user"]
                ]);
            }


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




    public Function GetReports(){
        $data_people = DB::table("request_sinister")
                ->join("clients_people", "clients_people.id_clients_people", "=", "request_sinister.id_client")
                ->orderBy("request_sinister.id","desc")
                ->get();


        $data_company = DB::table("request_sinister")
            ->selectRaw("request_sinister.*, clients_company.*, clients_company.business_name as names")
            ->join("clients_company", "clients_company.id_clients_company", "=", "request_sinister.id_client")
            ->orderBy("request_sinister.id","desc")
            ->get();

        $data = [];
        foreach($data_people as $value){
            $data[] = $value;
        }

        foreach($data_company as $value){
            $data[] = $value;
        }




        return response()->json($data)->setStatusCode(200);
    }



    public function ReportSinister(Request $request){
        $data = $request["file"];
        $folder = "img";
        $fileData = base64_decode($data);
        $fileName = rand(0, 100000000) . '-report.mp3';
        file_put_contents($folder . "/" . $fileName, $fileData);



        DB::table("request_sinister")->insert([
            "id_client" => $request["id_client"],
            "motivo"    => $request["motivo"],
            "type"      => $request["branch"],
            "file"      => $fileName,
        ]);

        return response()->json("Registro Exitoso")->setStatusCode(200);
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
