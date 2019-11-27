<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsWorkingInformation extends Model
{
    protected $fillable = [
        'id_clients_people',  'occupation',  'company'
    ];

    protected $table         = 'clients_people_working_information';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people';
}
