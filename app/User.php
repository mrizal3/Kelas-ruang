<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prodi_id', 'jabatan_id', 'nama', 'username', 'password', 'tipe_identitas', 'no_identitas', 'password', 'no_hp', 'alamat', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
    ];

    public $timestamps = false;

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'jabatan_id');
    }

}
