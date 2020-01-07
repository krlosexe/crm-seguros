<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinisters extends Model
{

    protected $fillable = [
        'state_policie', 'number_sinister', 'type_sinister', 'date_sinister', 'date_notice', 'date_notification_insurers', 'assigned_provider', 'descriptions', 'policie', 'compensation_value', 'deductible', 'claim_amount', 'coinsurance', 'finalized'
    ];

    protected $table         = 'sinisters';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_sinister';


    public function sinister_amparos_affected()
    {
      return $this->hasMany('App\SinisterAmparosAffected', 'id_sinister');
    }



}
