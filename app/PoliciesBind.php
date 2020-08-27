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
}
