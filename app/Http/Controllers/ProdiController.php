<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Repositories\ProdiRepository;
use Illuminate\Http\Request;

class ProdiController extends Controller
{

    public function __construct(ProdiRepository $prodi)
    {
        $this->prodi = $prodi;
    }
    
    public function index(Request $request)
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        
        return $this->prodi->store($request);   
    }

    public function edit($id)
    {
        return $this->prodi->edit($id);   
    }

    public function destroy($id)
    {
        return $this->prodi->destroy($id);   
    }
}
