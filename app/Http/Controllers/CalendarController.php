<?php


namespace App\Http\Controllers;

use App\Tasks;
use App\Queries;
use App\Surgeries;
use App\Valuations;
use App\Preanesthesia;
use App\RevisionAppointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function getTask(Request $request, $today = false){

        
        $data = Tasks::select("tasks.id_tasks", "tasks.responsable","tasks.issue as title", "tasks.delivery_date", "tasks.description", "tasks.delivery_date as start",
                             "tasks.description", "datos_personales.nombres", "datos_personales.apellido_p", 
                             "user_responsable.img_profile")
                           
                            ->join("datos_personales", "datos_personales.id_usuario", "=", "tasks.responsable")
                            ->join("users as user_responsable", "user_responsable.id", "=", "tasks.responsable")
                            
                            ->get();

     
        return response()->json($data)->setStatusCode(200);
    }




    public function Today(Request $request)
    {
      
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data["tasks"]          = $this->getTask($request, date("Y-m-d"))->original;
            $data["queries"]        = $this->getQueries($request, date("Y-m-d"))->original;
            $data["valuations"]     = $this->getValuations($request, date("Y-m-d"))->original;
            $data["surgeries"]      = $this->Surgeries($request, date("Y-m-d"))->original;
            $data["revision"]       = $this->Revision($request, date("Y-m-d"))->original;
            $data["preanestesia"]   = $this->Preanesthesia($request, date("Y-m-d"))->original;
            
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
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

}
