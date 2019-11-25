<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPeople extends Model
{
    protected $fillable = [
        'names',  'last_names',  'type_document',  'number_document',  'gender',  'birthdate', 'stratum',  'data_treatment',  'observations'
    ];

    protected $table         = 'clients_people';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people';
}
