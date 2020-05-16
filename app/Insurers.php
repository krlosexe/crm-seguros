<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurers extends Model
{
    protected $fillable = [
        'code','name', 'nit', 'email', 'address', 'phone', 'bank_account', 'code_adviser', 'link_cita',
    ];

    protected $table         = 'insurers';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_insurers';



    public function Branchs()
    {
      return $this->hasMany('App\InsurersBranchs', 'id_insurers')
                         ->join('branchs', 'branchs.id_branchs', '=', 'insurers_branchs.id_branch') 
                         ->select(array('insurers_branchs.*', 'branchs.name'));
    }


}
