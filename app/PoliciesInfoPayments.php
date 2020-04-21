<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesInfoPayments extends Model
{
    protected $fillable = [
        'id_policies', 'payment_period', 'payment_method', 'payment_terms'
    ];

    protected $table         = 'policies_info_payments';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_info_payments';
}
