<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Policies extends Model
{
    protected $fillable = [
        'number_policies', 'state_policies', 'is_renewable', 'insurers', 'branch', 'expedition_date', 'reception_date', 'start_date', 'end_date', 'risk', 'clients', 'type_clients', 'type_poliza', 'id_policies_grouped'
    ];

    protected $table         = 'policies';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies';


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




}
