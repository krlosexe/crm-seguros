<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesFamilyBurden extends Model
{
   protected $fillable = [
        'id_policie',
        'name', 
        'document', 
        'birthdate', 
        'relationship', 
        'date_init', 
        'cousin', 
        
    ];

    protected $table         = 'policies_family_burden';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_family_burden';
}
