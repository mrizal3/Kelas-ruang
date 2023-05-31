<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Prodi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    protected $guard = 'web';

    protected $redirectTo = '/';

    public function index()
    {
        if (auth()->guard('web')->user() != null) {
            if (auth()->user()->level == 0) {
                $redirect = '/admin/dashboard';
            }
            elseif (auth()->user()->level == 1) {
                $redirect = '/akademik/dashboard';
            }
            elseif (auth()->user()->level == 2) {
                $redirect = '/peminjam/dashboard';
            }
            return redirect($redirect);
        }
        return view('auth.login');
    }

    public function guard()
    {
        return auth()->guard('web');
    }

    public function login(Request $request)
    {
        if (auth()->guard('web')->attempt(['no_identitas' => $request->no_identitas, 'password' => $request->password ])) {
            if (auth()->user()->level == 0) {
                $redirect = '/admin/dashboard';
            }
            elseif (auth()->user()->level == 1) {
                $redirect = '/akademik/dashboard';
            }
            elseif (auth()->user()->level == 2) {
                $redirect = '/peminjam/dashboard';
            }
            return redirect($redirect);
        }

        return back()->withErrors(['error' => 'Username atau password salah']);
    }

    public function register()
    {
        if (auth()->guard('web')->user() != null) {
            if (auth()->user()->level == 0) {
                $redirect = '/admin/dashboard';
            }
            elseif (auth()->user()->level == 1) {
                $redirect = '/akademik/dashboard';
            }
            elseif (auth()->user()->level == 2) {
                $redirect = '/peminjam/dashboard';
            }
            return redirect($redirect);
        }
        
        $prodi = Prodi::all();
        $jabatan = Jabatan::all();
        return view('auth.register', compact('prodi', 'jabatan'));
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'prodi' => 'required',
            'no_identitas' => 'required',
            'tipe_identitas' => 'required',
            'no_hp' => 'min:11|max:12',
            'jabatan' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
        ]);

        $store = User::create([
            'prodi_id' => $request->prodi,
            'jabatan_id' => $request->jabatan,
            'nama' => $request->nama,
            'tipe_identitas' => $request->tipe_identitas,
            'no_identitas' => $request->no_identitas,
            'password' => bcrypt($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'level' => 2,
        ]);

        if ($store) {
            return setResponse($store);
        }
    }

    public function logout(Request $request)
    {
        $this->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
