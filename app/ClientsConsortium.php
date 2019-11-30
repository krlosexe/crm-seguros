<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsConsortium extends Model
{
    protected $fillable = [
        'name',  'identification'
    ];

    protected $table         = 'clients_consortium';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_consortium';
    
    public function partnersPeople()
    {
      return $this->hasMany('App\ConsortiumPartners', 'id_clients_consortium')->where('id_client_people', '!=', null)
                        ->join('clients_people', 'clients_people.id_clients_people', '=', 'consortium_partners.id_client_people') 
                        ->select(array('consortium_partners.*', 'clients_people.names', 'clients_people.last_names'));
    }

    public function partnersCompany()
    {
      return $this->hasMany('App\ConsortiumPartners', 'id_clients_consortium')->where('id_client_company', '!=', null)
                ->join('clients_company', 'clients_company.id_clients_company', '=', 'consortium_partners.id_client_company') 
                ->select(array('consortium_partners.*', 'clients_company.business_name'));
    }


}
