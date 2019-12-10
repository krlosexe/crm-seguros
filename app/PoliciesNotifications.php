<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliciesNotifications extends Model
{
    protected $fillable = [
        'id_policies', 'send_policies_for_expire_email', 'send_portfolio_for_expire_email', 'send_policies_for_expire_sms', 'send_portfolio_for_expire_sms'
    ];

    protected $table         = 'policies_notifications';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_policies_notifications';
}
