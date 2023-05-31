<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password_baru' => 'required',
            'password_lama' => 'required',
            'verifikasi_password_baru' => 'required|same:password_baru'
        ]);

        if (Hash::check($request->password_lama,getUser()->password)) {
            $ubah = User::where('id', getUser()->id)->update([
                'password' => bcrypt($request->password_baru)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Ubah Password',
                'data' => $ubah
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Password Lama Salah',
                'data' => ''
            ]);
        }
    }
}
