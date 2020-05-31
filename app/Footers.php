<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footers extends Model
{
    protected $fillable = [
        'name', 'content'
   ];  

     public $timestamps    = false;
     protected $table      = 'footers';
     protected $primaryKey = 'id_footers';
}



