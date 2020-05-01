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
    protected $primaryKey    = 'id_clients_people_contact';

    protected $with = ['departamento', 'city'];

    public function departamento(){
        return $this->hasOne('App\Departamentos', 'id', 'id_department');
    }

    public function city(){
        return $this->hasOne('App\Municipios', 'id', 'id_city');

    }

}
