<?php

namespace App\Repositories;

use App\Ruang;

class RuangRepository {

    protected $ruang;

    public function __construct(Ruang $ruang)
	{

	    $this->ruang = $ruang;
    }

    public function generateTable()
    {
        return createTable($this->ruang->all());
    }

    public function edit($id)
    {
        return $this->ruang->find($id);
    }

    public function store($request)
    {
        $request->validate([
            'kode' => 'required',
            'posisi' => 'required',
            'maksimal' => 'required|numeric'
        ]);

        $storeData = $this->ruang->updateOrCreate(['id' => $request->id],[
            'kode' => $request->kode,
            'posisi' => $request->posisi,
            'maksimal' => $request->maksimal,
            'keterangan' => $request->keterangan,
        ]);

        if ($storeData) {
            return setResponse($storeData);
        }
    }

    public function delete($id)
    {
        $searchRuang = $this->ruang->find($id);
        $deleteRuang = $searchRuang->delete();

        return setResponse($searchRuang);
    }

}