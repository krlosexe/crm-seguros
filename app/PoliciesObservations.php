<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesObservations extends Model
{
    protected $fillable = [
        'id_policies', 'internal_observations', 'observations'
    ];

    protected $table         = 'policies_observations';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_observations';
}
