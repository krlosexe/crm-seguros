<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsCompany extends Model
{
    protected $fillable = [
        'business_name',  'nit', 'expedition_date', 'constitution_date', 'data_treatment',  'observations'
    ];

    protected $table         = 'clients_company';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_company';

}
