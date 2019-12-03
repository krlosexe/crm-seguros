<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurersBranchs extends Model
{
    protected $fillable = [
        'id_insurers', 'id_branch', 'commission_percentage', 'vat_percentage'
    ];

    protected $table         = 'insurers_branchs';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_insurers_branchs';
}
