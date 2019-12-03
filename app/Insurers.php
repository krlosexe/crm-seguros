<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurers extends Model
{
    protected $fillable = [
        'name', 'nit', 'email', 'address', 'phone', 'bank_account'
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
