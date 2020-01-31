<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeAccount extends Model
{

    protected $fillable = [
        'id_policie','policie_annexes', 'number','init_date', 'limit_date', 'issue', 'observations', 'cousin', 'xpenses', 'vat', 'percentage_vat_cousin',
        'commission_percentage', 'agency_commission', 'total'
    ];

    protected $table         = 'charge_accounts';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_charge_accounts';
    
}
