<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurersSubCompany extends Model
{
    protected $fillable = [
        'id_surgerie', 'name', 'nit', 'type_sub_company', 'turn_check', 'to_name', 'court_of_accounts', 'ica', 'percentage_ica'
    ];

    protected $table         = 'insurers_sub_company';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_insurers_sub_company';
}
