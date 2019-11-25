<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPeopleChildrens extends Model
{
    protected $fillable = [
        'id_clients_people', 'name',  'phone',  'birthdate'
    ];

    protected $table         = 'clients_people_childrens';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people_childrens';
}
