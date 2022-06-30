<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'fecha', 'title', 'id_policie', 'id_user', 'view'
    ];
    protected $primaryKey = 'id_notifications';
    protected $table      = 'notifications';
}
