<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'municipios';

    protected $fillable = ['departamento_id', 'codigo', 'nombre'];

}
