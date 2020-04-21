<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeAccount extends Model
{

    protected $fillable = [
        'id_policie','policie_annexes', 'number','init_date', 'limit_date', 'issue', 'observations', 'cousin', 'xpenses', 'vat', 'percentage_vat_cousin',
        'commission_percentage', 'agency_commission', 'total', 'management_id'
    ];

    protected $table         = 'charge_accounts';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_charge_accounts';

    protected $with = ['policieAnexesData', 'policieData'];


    public function collections()
    {
      return $this->hasMany('App\Collections', 'id_charge_accounts');
    }


    public function policieAnexesData(){
      return $this->hasOne('App\PoliciesAnnexes', 'id_policie', 'id_policie');
    }

    public function policieData(){
      return $this->hasOne('App\Policies', 'id_policies', 'id_policie');
    }

    
}
