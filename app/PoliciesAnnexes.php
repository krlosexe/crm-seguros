<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesAnnexes extends Model
{
    protected $fillable = [
        'id_policie', 'number_annexed', 'state', 'risk', 'is_renewable',
        'reason', 'reason_description' ,'expedition_date', 'start_date', 'end_date', 'reception_date', 'cousin', 'xpenses', 'vat', 'percentage_vat_cousin',
        'commission_percentage', 'agency_commission', 'total', 'payment_method', 'observations', 'accessories'
    ];

    protected $table         = 'policies_annexes';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_annexes';

    protected $with = ['policie'];

    public function policie(){
    	return $this->hasOne('App\Policies', 'id_policies', 'id_policie')->with(['clientPeople', 'clientCompany', 'branch_data']);
    }
}
