<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesCousinsCommissions extends Model
{
    protected $fillable = [
        'id_policies', 'cousin', 'xpenses', 'vat', 'percentage_vat_cousin', 'commission_percentage', 'participation', 'agency_commission', 'total'
    ];

    protected $table         = 'policies_cousins_commissions';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_cousins_commissions';
}
