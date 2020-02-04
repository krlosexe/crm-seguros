<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
    protected $fillable = [
        'id_charge_accounts' ,'title', 'amount', 'name'
    ];

    protected $table         = 'collections';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_collections';
}
