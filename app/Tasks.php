<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'responsable', 'id_client', 'issue', 'delivery_date', 'description', 'file', 'state'
    ];

    protected $table         = 'tasks';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_tasks';




    public function comments(){
        return $this->hasMany('App\TasksComments', 'id_task')
                    ->join('users', 'users.id', '=', 'tasks_comments.id_user')  
                    ->join('datos_personales', 'datos_personales.id_usuario', '=', 'tasks_comments.id_user') 

                    ->where("tasks_comments.state", 1)
                    ->select(array('tasks_comments.*', 'users.email', 'users.img_profile', "datos_personales.nombres as name_user", 
                       "datos_personales.apellido_p as last_name_user"));   
    }
}
