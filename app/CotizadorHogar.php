<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CotizadorHogarInfluencers;

class CotizadorHogar extends Model
{
    protected $fillable = [
         'tipo_documento', 'documento', 'nombre', 'apellido', 'ciudad ', 'telefono', 'correo', 'influencer_id', 'status', 'created_at', 
    ];

    protected $table = 'cotizador_hogar';

    protected $appends = ['created_at_formated', 'fullname'];

    protected $with = ['influencer'];

    // custom attributes

    public function getCreatedAtFormatedAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));  
    }    

    public function getFullnameAttribute()
    {
        return $this->nombre.' '.$this->apellido;  
    }

    public function influencer(){
    	return $this->hasOne(new CotizadorHogarInfluencers, 'id', 'influencer_id');
    }


    public function scopeSearch($query, $str){
        if($str)
            return $query->where(function($q) use ($str){
                $q->orWhere('cotizador_hogar.nombre', 'LIKE', "%$str%");
                $q->orWhere('cotizador_hogar.apellido', 'LIKE', "%$str%");
                $q->orWhere('cotizador_hogar.telefono', 'LIKE', "%$str%");
                $q->orWhere('cotizador_hogar.correo', 'LIKE', "%$str%");
                $q->orWhere('cotizador_hogar_influencers.names', 'LIKE', "%$str%");
                $q->orWhere('cotizador_hogar_influencers.last_names', 'LIKE', "%$str%");

            });

    }

    public function scopePaginar($query, $start, $length){
        return $query->skip($start)->take($length);
    }
}
