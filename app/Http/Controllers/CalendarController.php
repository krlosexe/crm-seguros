<?php


namespace App\Http\Controllers;

use App\Tasks;
use App\User;
use App\Queries;
use App\Surgeries;
use App\Valuations;
use App\TasksComments;
use App\Preanesthesia;
use App\RevisionAppointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function getTask(Request $request, $today = false){
        ini_set('memory_limit', '-1');
            $data_user = User::select("users.*", "roles.nombre_rol", "datos_personales.*")
                                  ->join('datos_personales', 'datos_personales.id_usuario', '=', 'users.id')
                                  ->join("roles", "roles.id_rol", "=", "users.id_rol")
                                  ->where("id", $request["id_user"])
                                  ->first();

        $data = Tasks::select("tasks.id_tasks", "tasks.responsable","tasks.issue as title", "tasks.delivery_date", "tasks.description", "tasks.delivery_date as start",
                             "tasks.description", "tasks.state", "tasks.file", "tasks.id_client", "datos_personales.nombres", "datos_personales.apellido_p", 
                             "user_responsable.img_profile")
                           
                            ->join("datos_personales", "datos_personales.id_usuario", "=", "tasks.responsable")
                            ->join("users as user_responsable", "user_responsable.id", "=", "tasks.responsable");


                            if($data_user->nombre_rol != 'Administrador'){
                                $data->where('tasks.responsable', $request->id_user);
                            }


        $data = $data->with("comments")->where(function ($query) use ($today) {
                                if($today != false){
                                    $query->where("tasks.delivery_date", $today);
                                }
                            })->get();


        foreach($data as $key => $value){
            

            if($value["state"] == "Abierta"){
                $value["textColor"] = "#0f9aee";

                if(date("Y-m-d") > $value["delivery_date"]){
                    $value["color"] = "#FF3C7E";
                    $value["textColor"] = "white";
                }
            }


            if($value["state"] == "Finalizada"){
                $value["color"] = "#68D667";
                $value["textColor"] = "white";
            }

            if($value["state"] == "Cancelada"){
                $value["color"] = "#FF3C7E";
                $value["textColor"] = "white";
            }
            
        }

     
        return response()->json($data)->setStatusCode(200);
    }




    public function Today(Request $request)
    {
        $data = $this->getTask($request, date("Y-m-d"))->original;
        return response()->json($data)->setStatusCode(200);

    }

    public function Json_Super_Unique($array,$key){
        $temp_array = array();
        foreach ($array as &$v) {
            if (!isset($temp_array[$v[$key]]))
            $temp_array[$v[$key]] =& $v;
        }
        $array = array_values($temp_array);
        return $array;
     }



     public function DeleteComment(Request $request){
         
        $data["state"]       = 0;
        $data["user_delete"] = $request["id_user"];

        TasksComments::where("id_tasks_comments", $request["id"])->update($data);

        
        return response()->json("Ok")->setStatusCode(200);
     }

}
