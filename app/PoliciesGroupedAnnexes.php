<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesGroupedAnnexes extends Model
{
    protected $fillable = [
        'id_policies', 'number_annexed', 'state', 'risk', 'is_renewable',
        'reason', 'expedition_date', 'start_date', 'end_date', 'reception_date', 'cousin', 'xpenses', 'vat', 'percentage_vat_cousin',
        'commission_percentage', 'agency_commission', 'total', 'payment_method', 'observations', 'accessories'
    ];

    protected $table         = 'policies_grouped_annexes';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_grouped_annexes';
}
