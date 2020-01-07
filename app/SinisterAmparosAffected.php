<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinisterAmparosAffected extends Model
{
    protected $fillable = [
        'id_sinister', 'name_claimant', 'amparo', 'value'
    ];

    protected $table         = 'sinister_amparos_affected';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_sinister_amparos_affected';


}
/////////////////////////////////////////////////////////////////////////