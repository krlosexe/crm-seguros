<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculoCotizador extends Model
{
    protected $fillable = [
        'id_vehiculo', 'placa', 'clase_vehiculo', 'marca', 'modelo', 'referencia', 'tipo_servicio', 'ciudad_circulacion', 'nombre', 'apellido', 'tipo_documento_identidad', 'documento_identidad', 'correo', 'estatus', 'tipo_persona', 'plan', 'total', 'plan_json', 'status', 'created_at', 'updated_at'
    ];

    protected $table         = 'vehiculo_cotizador';
    public    $timestamps    = true;
    protected $primaryKey    = 'id_vehiculo';

    public function scopeSearch($query, $str){
        if($str)
            return $query->where(function($q) use ($str){
                $q->orWhere('placa', 'LIKE', "%$str%");
                $q->orWhere('correo', 'LIKE', "%$str%");
                $q->orWhere('nombre', 'LIKE', "%$str%");
                $q->orWhere('apellido', 'LIKE', "%$str%");

            });

    }

    public function scopePaginar($query, $start, $length){
        return $query->skip($start)->take($length);
    }

}
