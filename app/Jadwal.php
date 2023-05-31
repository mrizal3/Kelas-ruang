<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'prodi_id','kelas_id' ,'matkul_id' ,'ruang_id' ,'semester' , 'sks', 'hari' , 'jam_mulai' , 'jam_selesai' , 'keterangan', 'tahun_ajaran', 'angkatan', 'dosen_id'
    ];

    public function getJamMulaiAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['jam_mulai'])
        ->format('H:i');
    }

    public function getJamSelesaiAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['jam_selesai'])
        ->format('H:i');
    }
}
