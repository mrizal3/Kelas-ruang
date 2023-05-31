<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return createTable(MataKuliah::all());
        }

        return view('matkul.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $store = MataKuliah::updateOrCreate(['id' => $request->id], $request->except('id'));

        return setResponse($store);
    }

    public function edit($id)
    {
        return MataKuliah::find($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
