<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesFamiliares extends Model
{
    protected $fillable = ['id_policies', 'nombre', 'documento'];

    protected $table         = 'policies_familiares';
    
}
