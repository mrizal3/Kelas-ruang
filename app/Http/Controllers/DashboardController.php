<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Dosen;
use App\Peminjaman;
use App\Ruang;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('level', '!=', '0')->count();
        $dosen = Dosen::count();
        $ruang = Ruang::count();
        $barang = Barang::count();
        return view('dashboard.index', compact('user', 'dosen', 'ruang', 'barang'));
    }

    public function peminjam()
    {

        $ruang = [];

        $posisi = Ruang::select('posisi')
                    ->groupBy('posisi')
                    ->get();

        foreach ($posisi as $value) {
            $data_ruang = Ruang::where('posisi', $value->posisi)
                            ->get();

            $ruang[] = (object)[
                'posisi' => $value->posisi,
                'ruang' => $data_ruang
            ];
        }

        return view('peminjam.dashboard.index', compact('ruang'));
    }

    public function akademik()
    {
        $hari_ini = Peminjaman::whereBetween('tanggal_dibuat', [date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'])->get()->count();
        $total = Peminjaman::get()->count();
        $setujui = Peminjaman::where('status', 1)->count();
        $tolak = Peminjaman::where('status', 2)->count();
        return view('akademik.dashboard.index', compact('hari_ini', 'total', 'setujui', 'tolak'));
    }
}