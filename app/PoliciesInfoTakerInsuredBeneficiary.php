<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesInfoTakerInsuredBeneficiary extends Model
{
    protected $fillable = [
        'id_policies', 'name_taker', 'identification_taker', 'name_insured', 'identification_insured', 'beneficiary_remission', 'beneficairy_onerous', 'beneficairy_name', 'beneficairy_identification'
    ];

    protected $table         = 'policies_info_taker_insured_beneficiary';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies';
}
