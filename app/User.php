<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function clients_company()
    {
        return $this->belongsTo('App\ClientsCompany', 'email', 'nit');
    }



    public function logs(){
        return $this->hasMany('App\LogsPolicies', 'id_user', 'id')
                    ->join('users', 'users.id', '=', 'logs_policies.id_user')
                    ->join('policies', 'policies.id_policies', '=', 'logs_policies.id_policie')
                    ->join('datos_personales', 'datos_personales.id_usuario', '=', 'logs_policies.id_user')
                    ->orderBy("create_at", "DESC")
                    ->select(array('logs_policies.*', 'users.email', 'users.img_profile', "datos_personales.nombres as name_user",
                      "datos_personales.apellido_p as last_name_user", "policies.number_policies"));
    }


    public function logsSessiones(){
        return $this->hasMany('App\LogsSession', 'id_user', 'id')->orderBy("id", "DESC");
    }



}
