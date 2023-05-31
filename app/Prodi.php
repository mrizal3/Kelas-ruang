<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    public $timestamps = false;

    protected $fillable = [
       'fakultas_id', 'nama'
    ];
    
}