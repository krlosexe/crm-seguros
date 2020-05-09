<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'placa', 'model', 'color', 'number_motor', 'number_chassis', 'due_date_techno_mechanics', 'due_date_soat','value_fasecolda', 'code'
    ];

    protected $table         = 'vehicules';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_vehicules';

    public function scopeSearch($query, $str){
        if($str)
            return $query->where(function($q) use ($str){
                $q->orWhere('placa', 'LIKE', "%$str%");
                $q->orWhere('fasecolda.clase', 'LIKE', "%$str%");
                $q->orWhere('fasecolda.marca', 'LIKE', "%$str%");

                $range = [1970, 2021];

                foreach ($range as $year) {
                	$q->orWhere('year_'.$year, 'LIKE', "%$str%");
                }

            });

    }

    public function scopePaginar($query, $start, $length){
        return $query->skip($start)->take($length);
    }

}
