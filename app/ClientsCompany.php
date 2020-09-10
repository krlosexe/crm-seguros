<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsCompany extends Model
{
    protected $fillable = [
        'business_name',  'nit', 'expedition_date', 'constitution_date', 'data_treatment',  'observations'
    ];

    protected $table         = 'clients_company';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_company';
    
    protected $with = ['contact'];

    public function policies(){
        return $this->hasMany('App\Policies', 'clients')
                    ->with([
                        'policies_info_taker_insured_beneficiary',
                        'policies_cousins_commissions',
                        'policies_observations',
                        'policies_notifications',
                        'policies_info_payments',
                        'policies_bind',
                        'branch_data',
                        'insurers_data',

                    ])
                    ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                    ->where("auditoria.tabla", "policies")
                    ->where("auditoria.status", "!=", "0")
                    ->where('policies.state_policies', 'Vigente');
    }

    public function contact(){
        return $this->hasOne('App\ClientsCompanyContact', 'id_clients_company', 'id_clients_company');

    }
}
