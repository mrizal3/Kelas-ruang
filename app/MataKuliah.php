<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama', 'semester', 'sks'
    ];
    
}
