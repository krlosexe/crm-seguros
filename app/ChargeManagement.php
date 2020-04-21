<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeManagement extends Model
{

    protected $fillable = ['id_client', 'type_client', 'policie_annexes', 'issue', 'observations', 'init_date', 'limit_date', 'total'];

    protected $table         = 'charge_accounts_management';

    public    $timestamps    = false;


    public function chargeAccount()
    {
      return $this->hasMany('App\ChargeAccount', 'management_id')
		                        ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
		                        ->where("auditoria.tabla", "charge_accounts")
                                ->where("auditoria.status", "!=", "0");
    }

    
}
