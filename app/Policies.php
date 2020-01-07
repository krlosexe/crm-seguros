<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    protected $fillable = [
        'number_policies', 'state_policies', 'is_renewable', 'insurers', 'branch', 'expedition_date', 'reception_date', 'start_date', 'end_date', 'risk', 'clients', 'type_clients', 'type_poliza', 'id_policies_grouped'
    ];

    protected $table         = 'policies';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies';




    public function policies_bind()
    {
      return $this->hasMany('App\PoliciesBind', 'id_policie');
    }

}
///////