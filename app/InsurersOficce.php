<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurersOficce extends Model
{
    protected $fillable = [
        'id_surgerie', 'name', 'phone', 'fax', 'headquarters_default', 'name_contact', 'phone_contact', 'email_contact'
    ];

    protected $table         = 'insurers_oficce';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_insurers_oficce';
}
