<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'ruang_id', 'nomor', 'perihal', 'kepada', 'tanggal_dibuat', 'tanggal_mulai', 'tanggal_selesai', 'keterangan', 'status', 'jumlah_orang', 'agenda'
    ];

    public function detail_peminjaman()
    {
        return $this->hasMany('App\DetailPeminjaman', 'peminjaman_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ruang()
    {
        return $this->belongsTo('App\Ruang', 'ruang_id');
    }
}
