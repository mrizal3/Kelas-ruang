<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'prodi_id', 'kode'
    ];

    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'prodi_id');
    }
}
