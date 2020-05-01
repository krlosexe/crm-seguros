<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ClientsPeople extends Model
{
    protected $fillable = [
        'names',  'last_names',  'type_document',  'number_document',  'expedition_date',
        'weight', 'height', 'eps', 'gender',  'birthdate', 'stratum',  'data_treatment',  'observations'
    ];

    protected $table         = 'clients_people';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_people';

    protected $with = ['contact'];

    public function childrens()
    {
      return $this->hasMany('App\ClientsPeopleChildrens', 'id_clients_people');
    }

    public function vehicle()
    {
      return $this->hasMany('App\ClientsPeopleVehicle', 'id_clients_people');
    }


    public function policies(){
        return $this->hasMany('App\Policies', 'clients')
                    ->with([
                        'policies_info_taker_insured_beneficiary',
                        'policies_cousins_commissions',
                        'policies_observations',
                        'policies_notifications',
                        'policies_info_payments',
                    ])
                    ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                    ->where("auditoria.tabla", "policies")
                    ->where("auditoria.status", "!=", "0");
    }

    public function contact(){
        return $this->hasOne('App\ClientsPeopleContact', 'id_clients_people', 'id_clients_people');

    }
}
