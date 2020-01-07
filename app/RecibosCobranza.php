<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecibosCobranza extends Model
{
    protected $fillable = [
        'id_policie', 'monthly_fee', 'payment_date', 'type_operation', 'amount', 'payment', 'balance', 'status'
    ];

    protected $table         = 'recibos_cobranza';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_recibos_cobranza';
}
