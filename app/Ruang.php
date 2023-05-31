<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'kode', 'posisi', 'maksimal', 'keterangan'
    ];

}
