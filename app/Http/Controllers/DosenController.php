<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\MataKuliah;
use App\Prodi;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('dosens')
                    ->leftJoin('prodis', 'prodis.id', 'dosens.prodi_id')
                    ->select('dosens.id', 'prodis.nama as prodi', 'dosens.nama', 'nidn', 'no_hp', 'alamat')
                    ->get();
            return createTable($data);
        }

        $prodi = Prodi::all();
        $matkul = MataKuliah::all();

        return view('dosen.index', compact('prodi', 'matkul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi' => 'required',
            'nama' => 'required',
            'nidn' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $store = Dosen::updateOrCreate(['id' => $request->id],[
            'prodi_id' => $request->prodi,
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return setResponse($store);
    }

    public function edit($id)
    {
        return Dosen::find($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
