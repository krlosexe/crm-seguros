<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPeopleVehicle extends Model
{
    protected $fillable = [
        'id_clients_people', 'placa', 'date_soat', 'date_taxes', 'date_tecno'
    ];

    protected $table         = 'clients_people_vehicle';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people_vehicle';
}
