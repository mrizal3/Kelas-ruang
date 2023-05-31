<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Prodi;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return createTable(Kelas::with('prodi')->get());
        }

        $prodi = Prodi::all();

        return view('kelas.index', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required'
        ]);

        $store = Kelas::updateOrCreate(['id' => $request->id],[
            'prodi_id' => $request->prodi,
            'kode' => $request->kode
        ]);

        return setResponse($store);
    }

    public function edit($id)
    {
        return Kelas::find($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
