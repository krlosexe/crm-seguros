<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
        'id_register', 'name', 'title','descripcion', 'tabla'
   ];  

     public $timestamps    = false;
     protected $table      = 'files';
     protected $primaryKey = 'id_files';
}
