<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamentos';

    protected $fillable = ['nombre', 'codigo', 'cod', 'color'];

}
