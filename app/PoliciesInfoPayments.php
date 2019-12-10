<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesInfoPayments extends Model
{
    protected $fillable = [
        'id_policies', 'payment_method', 'half_payment', 'bank'
    ];

    protected $table         = 'policies_info_payments';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_info_payments';
}
