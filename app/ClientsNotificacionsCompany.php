<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsNotificacionsCompany extends Model
{
    protected $fillable = [
        'id_clients', 'id_clients_company', 'send_policies_for_expire_email',  'send_portfolio_for_expire_email',  'send_policies_for_expire_sms',  'send_portfolio_for_expire_sms',  'send_birthday_card'
    ];

    protected $table         = 'clients_notifications';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_clients_company';
}
