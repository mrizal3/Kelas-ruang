<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'prodi_id', 'nama', 'nidn', 'no_hp', 'alamat'
    ];
    
}
