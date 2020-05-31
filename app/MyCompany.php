<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyCompany extends Model
{
    protected $fillable = [
        'logo', 'name', 'nit', 'phone', 'email'
    ];

    protected $table         = 'my_company';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_my_company';

}
