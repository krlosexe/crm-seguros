<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'responsable', 'issue', 'delivery_date', 'description'
    ];

    protected $table         = 'tasks';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_tasks';


}
