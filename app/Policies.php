<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Policies extends Model
{
    protected $fillable = [
        'number_policies', 'state_policies', 'file_caratula','is_renewable', 'insurers', 'branch', 'expedition_date', 'reception_date', 'start_date', 'end_date', 'risk', 'clients', 'type_clients', 'type_poliza', 'id_policies_grouped'
    ];

    protected $table         = 'policies';

    public    $timestamps    = false;

    protected $primaryKey    = 'id_policies';

    protected $appends = ['route_caratula'];


    function getRouteCaratulaAttribute()
    {
        return getenv('APP_URL').'img/policies/caratulas/'.$this->file_caratula;
    }    

    public function scopeSearch($query, $str){
        if($str)
            return $query->where(function($q) use ($str){
                $q->orWhere('number_policies', 'LIKE', "%$str%");
                $q->orWhere(DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names)"), 'LIKE', "%$str%");
                $q->orWhere('business_name', 'LIKE', "%$str%");
                $q->orWhere('insurers.name', 'LIKE', "%$str%");
                $q->orWhere('branchs.name', 'LIKE', "%$str%");
                $q->orWhere('type_poliza', 'LIKE', "%$str%");
                $q->orWhere('state_policies', 'LIKE', "%$str%");
            });

    }

    public function scopePaginar($query, $start, $length){
        return $query->skip($start)->take($length);
    }


    public function policies_bind()
    {
      return $this->hasMany('App\PoliciesBind', 'id_policie');
    }


    public function vehicules()
    {
      return $this->hasMany('App\PolicesVehicles', 'id_policie');
    }

    public function familiares()
    {
      return $this->hasMany('App\PoliciesFamiliares', 'id_policies');
    }


    public function clientPeople()
    {
      return $this->hasOne('App\ClientsPeople', 'id_clients_people', 'clients');
    }

    public function clientCompany()
    {
      return $this->hasOne('App\ClientsCompany', 'id_clients_company', 'clients');
    }

    public function branch_data(){
      return $this->hasOne('App\Branchs', 'id_branchs', 'branch');
    }

    public function insurers_data(){
      return $this->hasOne('App\Insurers', 'id_insurers', 'insurers');
    }





    // Obtener datos con otras tablas

    public function policies_info_taker_insured_beneficiary(){
        return $this->hasOne('App\PoliciesInfoTakerInsuredBeneficiary', 'id_policies');
    }

    public function policies_cousins_commissions(){
        return $this->hasOne('App\PoliciesCousinsCommissions', 'id_policies');
    }

    public function policies_observations(){
        return $this->hasOne('App\PoliciesObservations', 'id_policies');
    }

    public function policies_notifications(){
        return $this->hasOne('App\PoliciesNotifications', 'id_policies');
    }
    
    public function policies_info_payments(){
        return $this->hasOne('App\PoliciesInfoPayments', 'id_policies');
    }



}
