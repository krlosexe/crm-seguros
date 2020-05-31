<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
    protected $fillable = [
        'id_charge_accounts', 'amount', 'name', 'payment_date', 'bank', 'way_to_pay'
    ];

    protected $table         = 'collections';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_collections';
}
