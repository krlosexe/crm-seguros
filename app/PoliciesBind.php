<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesBind extends Model
{
    protected $fillable = [
        'id_policie', 'number_annexed', 'number_affiliate', 'date_init', 'insured_object', 
        'cousin', 'name_affiliate', 'document_affiliate', 'relationship', 'birthdate', 
        'gender', 'phone', 'email', 'address', 'plan', 'type_rate', 'type_membership', 
        'percentage_vat', 'expenses', 'vat', 'total', 'company', 
        'employee', 'internal_observations', 'observations', 'beneficairy_onerous', 'beneficairy_name', 'beneficairy_identification','file_caratula', 
    ];

    protected $table         = 'policies_bind';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_bind';

    protected $with = ['policies_family_burden'];

    protected $appends = ['route_caratula'];

    function getRouteCaratulaAttribute()
    {
        return getenv('APP_URL').'img/policies/caratulas/'.$this->file_caratula;
    }    

    function policies_family_burden(){
        return $this->hasMany('App\PoliciesFamilyBurden', 'id_policie', $this->primaryKey);
    }

    function policie_parent(){
        return $this->belongsTo('App\Policies', 'id_policie')
                    ->with([
                        'policies_info_taker_insured_beneficiary',
                        'policies_cousins_commissions',
                        'policies_observations',
                        'policies_notifications',
                        'policies_info_payments',
                        'branch_data',
                        'insurers_data',
                    ])
                    ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                    ->where("auditoria.tabla", "policies");
    }

}
