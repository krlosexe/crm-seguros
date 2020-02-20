<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'placa', 'model', 'color', 'number_motor', 'number_chassis', 'due_date_techno_mechanics', 'value_fasecolda', 'code'
    ];

    protected $table         = 'vehicules';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_vehicules';
}
