<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitales extends Model
{
    protected $table ='hospitales';
    protected $fillable = ['name', 'lat', 'long'];
    
}
