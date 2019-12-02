<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurers extends Model
{
    protected $fillable = [
        'name', 'nit', 'email', 'address', 'phone', 'bank_account'
    ];

    protected $table         = 'insurers';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_insurers';
}
