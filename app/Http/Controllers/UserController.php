<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use App\User;
use App\Prodi;
use App\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')
                    ->join('prodis', 'prodis.id', 'users.prodi_id')
                    ->join('jabatans', 'jabatans.id', 'users.jabatan_id')
                    ->where('users.level', '!=', 0)
                    ->select('users.id', 'users.nama', 'prodis.nama as prodi', 'jabatans.nama as jabatan', 'no_hp', 'alamat', 'level')
                    ->get();
            return createTable($data);
        }

        $jabatan = Jabatan::all();
        $prodi = Prodi::all();

        return view('user.index', compact('jabatan', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'prodi' => 'required',
            'tipe_identitas' => 'required',
            'no_identitas' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'min:11|max:12',
            'level' => 'required',
        ]);

        if ($request->id != null) {
            $search = $this->edit($request->id);
        
            if ($search != null) {
                $password = Hash::check('secret123',$search->password) ? bcrypt('secret123') : $search->password;
            }
            else {
                $password = bcrypt('secret123');
            }
        }
        else {
            $password = bcrypt('secret123');
        }

        $store = User::updateOrCreate(['id' => $request->id],[
            'prodi_id' => $request->prodi,
            'jabatan_id' => $request->jabatan,
            'nama' => $request->nama,
            'tipe_identitas' => $request->tipe_identitas,
            'no_identitas' => $request->no_identitas,
            'password' => $password,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'level' => $request->level,
        ]);

        if ($store) {
            return setResponse($store);
        }
        
    }

    public function edit($id)
    {
        return User::findOrFail($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
