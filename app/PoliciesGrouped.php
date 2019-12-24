<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesGrouped extends Model
{
    protected $fillable = [
        'number_policies', 'insurers', 'branch', 'name_taker', 'identification_taker', 'start_date', 'end_date', 'reception_date', 'is_renewable'
    ];

    protected $table         = 'policies_grouped';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_grouped';
}
