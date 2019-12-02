<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table         = 'branchs';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_branchs';
}
