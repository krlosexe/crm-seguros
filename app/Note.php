<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'id_user', 'title', 'content'
    ];

    protected $table         = 'note';
    public    $timestamps    = false;
    protected $primaryKey    = 'id_note';
}
