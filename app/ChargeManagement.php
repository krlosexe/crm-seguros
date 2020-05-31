<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChargeManagement extends Model
{

    protected $fillable = ['id_client', 'type_client', 'policie_annexes', 'issue', 'observations', 'init_date', 'limit_date', 'total', 'status'];

    protected $table         = 'charge_accounts_management';

    public    $timestamps    = false;

    protected $with = ['collections'];

    public function chargeAccount()
    {
      return $this->hasMany('App\ChargeAccount', 'management_id')
		                        ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
		                        ->where("auditoria.tabla", "charge_accounts")
                                ->where("auditoria.status", "!=", "0");
    }

    public function scopeAllWithAuditoria($query, $fechadesde, $fechahasta){
        $query->select('charge_accounts_management.*')
              ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts_management.id")
              ->where("auditoria.tabla", "charge_accounts_management")
              ->where("auditoria.status", "!=", "0")
              ->where('auditoria.fec_regins', '>=', $fechadesde)
              ->where('auditoria.fec_regins', '<=', $fechahasta);
                          
    }

    public function client(){
     return $this->hasOne('App\ClientsPeople', 'id_clients_people', 'id_client')
                 ->select('clients_people.*', DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname")); 
    }

    public function company(){
     return $this->hasOne('App\ClientsCompany', 'id_clients_company', 'id_client');   
    }


    public function collections()
    {
      return $this->hasMany('App\Collections', 'id_charge_accounts');
    }


    
}
