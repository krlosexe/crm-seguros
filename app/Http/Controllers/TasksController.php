<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\Auditoria;
use App\TasksFollowers;
use App\TasksComments;
use App\Note;
use Illuminate\Http\Request;

use DateTime;



class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $rol     = $request["rol"];
            $id_user = $request["id_user"];

            $tasks = Tasks::select("tasks.*", "responsable.email as email_responsable", "datos_personales.nombres as name_responsable", 
                                   "datos_personales.apellido_p as last_name_responsable", "auditoria.*", "users.email as email_regis")

                                ->join("auditoria", "auditoria.cod_reg", "=", "tasks.id_tasks")
                                ->join("users", "users.id", "=", "auditoria.usr_regins")

                                ->join("users as responsable", "responsable.id", "=", "tasks.responsable")
                                ->join("datos_personales", "datos_personales.id_usuario", "=", "responsable.id")

                                ->with("comments")

                                ->where("auditoria.tabla", "tasks")
                                ->where("auditoria.status", "!=", "0")
                                ->orderBy("tasks.id_tasks", "DESC")
                                ->get();
                             
            echo json_encode($tasks);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
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
        $fecha = $request["delivery_date"];


        if($request->file('file')){

            $file = $request->file('adjunto');

            $destinationPath = 'img/tasks';
            $file->move($destinationPath,$file->getClientOriginalName());
            $request["file"] = $file->getClientOriginalName();

        }


        $dt = new DateTime($fecha);
        $request["delivery_date"] = $dt->format('Y-m-d');
        $store = Tasks::create($request->all());
        $id_task = $store->id_tasks;

        if(isset($request["comments"])){
            $comments = [];
            foreach($request["comments"] as $key => $value){
                $array = [];
                $array["id_task"]     = $id_task;
                $array["id_user"]     = $request["id_user"];
                $array["comments"]    = $value;
                array_push($comments, $array);
            }
            TasksComments::insert($comments);
        }


        if ($store) {
            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("A ocurrido un error")->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tasks)
    {
        $fecha = $request["delivery_date"];

        $dt = new DateTime($fecha);
        $request["delivery_date"] = $dt->format('Y-m-d');
            
        $update = Tasks::find($tasks)->update($request->all());


        if(isset($request["comments"])){
            $comments = [];
            foreach($request["comments"] as $key => $value){
                $array = [];
                $array["id_task"]     = $tasks;
                $array["id_user"]     = $request["id_user"];
                $array["comments"]    = $value;
                array_push($comments, $array);
            }

            TasksComments::insert($comments);
        }


        if ($update) {
            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("A ocurrido un error")->setStatusCode(400);
        }

       
    }



    

    public function status($id, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $auditoria =  Auditoria::where("cod_reg", $id)
                                     ->where("tabla", "tasks")->first();
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


    public function CreateNote(Request $request){
        $data = Note::create($request->all());
        return response()->json("Ok")->setStatusCode(200);
    }




    public function ListNote($user){
        
        $data = Note::where("id_user", $user)->get();
        return response()->json($data)->setStatusCode(200);

    }


    
    public function UpdateNote(Request $request, $id){
        $update = Note::find($id)->update($request->all());
        return response()->json("Ok")->setStatusCode(200);
    }


    public function DeleteNote($id){
        $update = Note::find($id)->delete();
        return response()->json("Ok")->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($tasks)
    {
        $update = Tasks::find($tasks)->delete();
        return response()->json("ok")->setStatusCode(200);
    }
}
