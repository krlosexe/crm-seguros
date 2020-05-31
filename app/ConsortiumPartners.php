<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsortiumPartners extends Model
{
    protected $fillable = [
        'id_clients_consortium' ,'id_client_people',  'id_client_company'
    ];

    protected $table         = 'consortium_partners';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_consortium_partners';


    
}
