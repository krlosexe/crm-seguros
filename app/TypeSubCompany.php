<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSubCompany extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table         = 'type_sub_company';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_type_sub_company';
}
