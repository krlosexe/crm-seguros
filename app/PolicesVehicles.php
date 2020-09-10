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

    protected $with = ['policie', 'vehicle'];

    function policie(){
    	return $this->belongsTo('App\Policies', 'id_policie')->with(['branch_data', 'insurers_data']);
    }

    function vehicle(){
    	return $this->hasOne('App\Vehicle', 'placa', 'placa');
    }
}
