<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FakultasRepository;
use App\Repositories\ProdiRepository;

class FakultasController extends Controller
{
    public function __construct(FakultasRepository $fakultas, ProdiRepository $prodi)
    {
        $this->fakultas = $fakultas;
        $this->prodi = $prodi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->fakultas->generateTable();
        }
        return view('fakultas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->fakultas->store($request);
    }

    public function show(Request $request, $id)
    {
        $this->fakultas->edit($id);
        if ($request->ajax()) {
            return $this->prodi->generateTable($id);
        }

        return view('prodi.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->fakultas->edit($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->fakultas->delete($id);
    }
}
