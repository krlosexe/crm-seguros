<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    protected $fillable = [
        'number_policies', 'state_policies', 'is_renewable', 'insurers', 'branch', 'expedition_date', 'reception_date', 'start_date', 'end_date', 'risk', 'clients', 'type_clients'
    ];

    protected $table         = 'policies';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies';
}
