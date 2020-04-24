<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPeopleContact extends Model
{
    protected $fillable = [
        'id_clients_people', 'id_department',  'id_city',  'address1',  'type_address1',  'address2',  'type_address2', 'phone1',  'type_phone1',  'phone2', 'type_phone2',  'email'
    ];

    protected $table         = 'clients_people_contact';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people';


}
