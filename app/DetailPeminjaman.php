<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamans';

    public $timestamps = false;

    protected $fillable = [
        'peminjaman_id', 'barang_id', 'jumlah'
    ];


    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id');
    }
}
