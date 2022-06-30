<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogsPolicies extends Model
{
    protected $fillable = [
        'id_user','id_policie', 'event', 'create_at'
    ];

    protected $table         = 'logs_policies';
    public    $timestamps    = false;
}
