<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksComments extends Model
{
    protected $fillable = [
        'id_task','id_user', 'comments'
    ];

    protected $table         = 'tasks_comments';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_tasks_comments';
}
