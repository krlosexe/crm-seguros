<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolicesVehicles extends Model
{
    protected $fillable = [
        'id_policie', 'placa'
    ];

    protected $table         = 'policies_vehicle';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_vehicle';
}
