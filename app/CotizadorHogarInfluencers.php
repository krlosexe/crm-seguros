<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizadorHogarInfluencers extends Model
{
    protected $fillable = [
         'names', 'last_names', 'email', 'code', 'created_at'
    ];

    protected $table = 'cotizador_hogar_influencers';

    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->names.' '.$this->last_names;  
    }

}
