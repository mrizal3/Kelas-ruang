<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama_barang', 'jumlah', 'gambar', 'keterangan'
    ];

    
}
