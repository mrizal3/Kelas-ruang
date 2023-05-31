<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return createTable(Barang::all());
        }

        return view('barang.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $store = Barang::updateOrCreate(['id' => $request->id], $request->except('id'));
        return setResponse($store);

    }

    public function edit($id)
    {
        return Barang::find($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
