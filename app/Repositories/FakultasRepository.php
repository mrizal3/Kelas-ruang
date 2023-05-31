<?php

namespace App\Repositories;

use App\Fakultas;

class FakultasRepository {

    protected $fakultas;

    public function __construct(Fakultas $fakultas)
	{

	    $this->fakultas = $fakultas;
    }

    public function generateTable()
    {
        return createTable($this->fakultas->all());
    }

    public function edit($id)
    {
        return $this->fakultas->findOrFail($id);
    }

    public function store($request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $storeData = $this->fakultas->updateOrCreate(['id' => $request->id],[
            'nama' => $request->nama,
        ]);

        if ($storeData) {
            return setResponse($storeData);
        }
    }

    public function delete($id)
    {
        $searchFakultas = $this->fakultas->find($id);
        $deleteFakultas = $searchFakultas->delete();

        return setResponse($searchFakultas);
    }

}