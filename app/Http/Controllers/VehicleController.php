<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Auditoria;
use App\Fasecolda;
use Illuminate\Http\Request;
use App\Files;
use DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Vehicle::select("vehicules.*", "fasecolda.marca", "fasecolda.clase","fasecolda.codigo","fasecolda.homologocodigo","fasecolda.referencia1","fasecolda.referencia2",
                                "fasecolda.referencia3","fasecolda.peso","fasecolda.servicio","fasecolda.bcpp","fasecolda.importado","fasecolda.potencia","fasecolda.tipo_caja","fasecolda.cilindraje",
                                "fasecolda.nacionalidad","fasecolda.capacidad_pasajeros","fasecolda.capacidad_carga","fasecolda.puertas","fasecolda.a/i","fasecolda.ejes","fasecolda.estado",
                                "fasecolda.combustible","fasecolda.transmision","fasecolda.um" ,                     
                                "auditoria.*", "user_registro.email as email_regis")


                                ->join("auditoria", "auditoria.cod_reg", "=", "vehicules.id_vehicules")
                                ->where("auditoria.tabla", "vehicules")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code")
                                ->limit(10)
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("vehicules.id_vehicules", "DESC")
                                ->get();


        foreach($data as $value){
            $fasecolda = Fasecolda::select("fasecolda.year_".$value["model"]."")
                            ->where("codigo", $value["code"])
                            ->first();

            $value["valor_fasecolda"] = $fasecolda["year_".$value["model"].""] * 1000;
        }
           
        return response()->json($data)->setStatusCode(200);
    }


    public function paginate(Request $request)
    {

        ini_set('memory_limit', '-1'); 
        
        $searchValue = $request->search['value']; // value
        $start       = $request->start;
        $length      = $request->length;
        $draw        = $request->draw;

        $query = Vehicle::select("fasecolda.clase")
                                ->join("auditoria", "auditoria.cod_reg", "=", "vehicules.id_vehicules")
                                ->where("auditoria.tabla", "vehicules")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code", "left")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("vehicules.id_vehicules", "DESC");

            // se cuentan todos

            $dbTemp = Clone $query;
            $recordsTotal = $dbTemp->get()->count();
            // se aplica el filtro y se cuentan los registros filtrados

            $query->search($searchValue);

            $dbFiltered = Clone $query;
            $recordsFiltered = $dbFiltered->get()->count();

            // Select completo final con relaciones 

            $query->select(
                        "vehicules.*", 
                        "fasecolda.marca", 
                        "fasecolda.clase",
                        "fasecolda.codigo",
                        "fasecolda.homologocodigo",
                        "fasecolda.referencia1",
                        "fasecolda.referencia2",
                        "fasecolda.referencia3",
                        "fasecolda.peso",
                        "fasecolda.servicio",
                        "fasecolda.bcpp",
                        "fasecolda.importado",
                        "fasecolda.potencia",
                        "fasecolda.tipo_caja",
                        "fasecolda.cilindraje",
                        "fasecolda.nacionalidad",
                        "fasecolda.capacidad_pasajeros",
                        "fasecolda.capacidad_carga",
                        "fasecolda.puertas",
                        "fasecolda.a/i",
                        "fasecolda.ejes",
                        "fasecolda.estado",
                        "fasecolda.combustible",
                        "fasecolda.transmision",
                        "fasecolda.um" ,                     
                        "auditoria.*", 
                        "user_registro.email as email_regis"
            );

            $data = $query->paginar($start, $length)->get();

            foreach($data as $value){
                $fasecolda = Fasecolda::select("fasecolda.year_".$value["model"]."")
                                ->where("codigo", $value["code"])
                                ->first();

                $value->valor_fasecolda = $fasecolda["year_".$value["model"].""] * 1000;
            }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data
        ])->setStatusCode(200);
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
          
            $store = Vehicle::create($request->all());

            $destinationPath        = 'img/vehicles';
            $request["tabla"]       = "vehicules";
            $request["id_register"] = $store["id_vehicules"];

            if($request->file('file')){
                foreach($request->file('file') as $key => $value){
                    $value->move($destinationPath,$value->getClientOriginalName());
    
                    $request["name"] = $value->getClientOriginalName();
    
                    $request["title"]       = $request["titles"][$key];
                    $request["descripcion"] = $request["descriptions"][$key];
    
                    $store_file = Files::create($request->all());
    
                    $auditoria              = new Auditoria;
                    $auditoria->tabla       = "files";
                    $auditoria->cod_reg     = $store_file["id_files"];
                    $auditoria->status      = 1;
                    $auditoria->usr_regins  = $request["id_user"];
                    $auditoria->save();
                }
            }

            $auditoria              = new Auditoria;
            $auditoria->tabla       = "vehicules";
            $auditoria->cod_reg     = $store->id_vehicules;
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
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */

    public function vehiclePlaca($placa){
        $data = Vehicle::select("vehicules.*", "fasecolda.marca", "fasecolda.clase","fasecolda.codigo","fasecolda.homologocodigo","fasecolda.referencia1","fasecolda.referencia2",
                                "fasecolda.referencia3","fasecolda.peso","fasecolda.servicio","fasecolda.bcpp","fasecolda.importado","fasecolda.potencia","fasecolda.tipo_caja","fasecolda.cilindraje",
                                "fasecolda.nacionalidad","fasecolda.capacidad_pasajeros","fasecolda.capacidad_carga","fasecolda.puertas","fasecolda.a/i","fasecolda.ejes","fasecolda.estado",
                                "fasecolda.combustible","fasecolda.transmision","fasecolda.um" ,                     
                                "auditoria.*", "user_registro.email as email_regis")


                                ->join("auditoria", "auditoria.cod_reg", "=", "vehicules.id_vehicules")
                                ->where("auditoria.tabla", "vehicules")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code")
                                ->where('vehicules.placa', $placa)
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("vehicules.id_vehicules", "DESC")
                                ->first();


        foreach($data as $value){
            $fasecolda = Fasecolda::select("fasecolda.year_".$value["model"]."")
                            ->where("codigo", $value["code"])
                            ->first();

            $value["valor_fasecolda"] = $fasecolda["year_".$value["model"].""] * 1000;
        }

        return response()->json($data)->setStatusCode(200);
    }

    public function show($placa)
    {
        $data = Vehicle::select("vehicules.*", "fasecolda.marca", "fasecolda.clase","fasecolda.codigo","fasecolda.homologocodigo","fasecolda.referencia1","fasecolda.referencia2",
                                "fasecolda.referencia3","fasecolda.peso","fasecolda.servicio","fasecolda.bcpp","fasecolda.importado","fasecolda.potencia","fasecolda.tipo_caja","fasecolda.cilindraje",
                                "fasecolda.nacionalidad","fasecolda.capacidad_pasajeros","fasecolda.capacidad_carga","fasecolda.puertas","fasecolda.a/i","fasecolda.ejes","fasecolda.estado",
                                "fasecolda.combustible","fasecolda.transmision","fasecolda.um" ,                     
                                "auditoria.*", "user_registro.email as email_regis")


                                ->join("auditoria", "auditoria.cod_reg", "=", "vehicules.id_vehicules")
                                ->where("auditoria.tabla", "vehicules")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")

                                ->join("fasecolda", "fasecolda.codigo", "=", "vehicules.code")
                                
                                ->where("auditoria.status", "!=", "0")


                                ->where("vehicules.placa", $placa)
                                ->orderBy("vehicules.id_vehicules", "DESC")
                                ->first();

        

        $fasecolda = Fasecolda::select("fasecolda.*")
                            ->where("codigo", $data["code"])
                            ->first();


        $data->valor_fasecolda = $fasecolda["year_".$data->model.""] * 1000;

           
        return response()->json($data)->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle)
    {

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $update = Vehicle::find($vehicle)->update($request->all());

            if ($update) {
                $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("A ocurrido un error")->setStatusCode(400);
            }
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }



        
    }


    public function status($id, $status, Request $request){
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "vehicules")->first();

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



    public function asyncPlacaVehiculos(Request $request){


        $data = DB::table('vehicules')->select('*')
        ->where('placa', 'like', '%'.$request['search'].'%')

        ->join("auditoria", "auditoria.cod_reg", "=", "vehicules.id_vehicules")
        ->where("auditoria.tabla", "vehicules")
        ->where("auditoria.status", "!=", "0")
        
        ->orderBy("vehicules.id_vehicules", "DESC")
        ->limit(10)->get();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
