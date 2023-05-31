<?php

namespace App\Repositories;

use App\Prodi;

class ProdiRepository {

    protected $prodi;

    public function __construct(Prodi $prodi)
	{
	    $this->prodi = $prodi;
    }

    public function generateTable($id)
    {
        return createTable($this->prodi->where('fakultas_id', $id)->get());
    }

    public function edit($id)
    {
        return $this->prodi->findOrFail($id);
    }

    public function store($request)
    {
        $storeData = $this->prodi->updateOrCreate(['id' => $request->id], $request->except('id'));
        return setResponse($storeData);
    }

    public function destroy($id)
    {
        $prodi = $this->edit($id);

        $delete = $prodi->delete();

        return setResponse($delete);
    }

}