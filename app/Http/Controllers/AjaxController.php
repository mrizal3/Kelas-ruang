<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kelas;
use App\MataKuliah;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function searchKelas($id)
    {
        return $kelas = Kelas::where('prodi_id', $id)->get();
    }

    public function searchMatkul($id)
    {
        return $matkul = MataKuliah::where('id', $id)->first();
    }

    public function searchBarangId($id)
    {
        return $barang = Barang::where('id', $id)->first();
    }
}
