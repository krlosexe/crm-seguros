<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPeopleInfoCrm extends Model
{
    protected $fillable = [
        'id_clients_people', 'marital_status',  'monthly_income',  'heritage',  'own_house',  'number_house'
    ];

    protected $table         = 'clients_people_info_crm';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people_info_crm';
}
