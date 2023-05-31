<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
class JabatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return createTable(Jabatan::all());
        }

        return view('jabatan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $store = Jabatan::updateOrCreate(['id' => $request->id], $request->except('id'));

        return setResponse($store);
    }

    public function edit($id)
    {
        return Jabatan::find($id);
    }

    public function destroy($id)
    {
        $delete = $this->edit($id);

        if ($delete->delete()) {
            return setResponse($delete);
        }
    }
}
