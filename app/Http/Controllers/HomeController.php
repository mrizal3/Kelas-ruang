<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ruang;

class HomeController extends Controller
{

    public function index(Request $request)
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

        return view('home.index', compact('ruang'));
    }

    public function ruang(Request $request)
    {
        $prodi = Prodi::all();
        $tahun_sebelumnya = date('Y')-1; //2020
        $tahun_ini = date('Y'); //2021
        $tahun_i = $tahun_ini+1; // 2022
        $ths = $tahun_sebelumnya.'/'.$tahun_ini; // 2020-2021
        $thi = $tahun_ini.'/'.$tahun_i; // 2021- 2022

        if (date('m') > 6) {
            $tahun_ajaran = $thi; // 2021- 2022
        }
        else {
            $tahun_ajaran = $ths; // 2020-2021
        }

        for ($i=1; $i < 7 ; $i++) { 
            $data = DB::table('jadwals')
                    ->leftJoin('kelas', 'kelas.id', 'jadwals.kelas_id')
                    ->leftJoin('mata_kuliahs', 'mata_kuliahs.id', 'jadwals.matkul_id')
                    ->leftJoin('prodis', 'prodis.id', 'jadwals.prodi_id')
                    ->leftJoin('dosens', 'dosens.id', 'jadwals.dosen_id')
                    ->leftJoin('ruangs', 'ruangs.id', 'jadwals.ruang_id')
                    ->where('hari',$i)
                    ->where('tahun_ajaran', $tahun_ajaran)
                    ->orderBy('tahun_ajaran')
                    ->select('jadwals.id', 'hari', 'jam_mulai', 'jam_selesai', 'mata_kuliahs.nama as matkul', 'kelas.kode as kelas', 'jadwals.semester as semester', 'jadwals.sks', 'dosens.nama as dosen', 'prodis.nama as prodi', 'jadwals.keterangan', 'ruangs.kode as ruang');
            
            if ($request->prodi != null) {
                $data->where('jadwals.prodi_id', $request->prodi);
            }

            if ($request->kelas != null) {
                $data->where('jadwals.kelas_id', $request->kelas);
            }

            if ($request->angkatan != null) {
                $data->where('jadwals.angkatan', $request->angkatan);
            }

            if ($request->semester != null) {
                $data->where('jadwals.semester', $request->semester);
            }
                
                    

            $hasil[] = (object)[
                'hari' => dayFormatIndo($i),
                'data' => $data->get()
            ];
        }

        if ($request->prodi != null || $request->kelas != null || $request->semester != null || $request->angkatan != null) {
            $data_jadwal = $hasil;
        }
        else {
            $data_jadwal = [];
        }

        return view('home.ruang', compact('data_jadwal', 'prodi'));
    }

    public function detail($id)
    {
        $tahun_sebelumnya = date('Y')-1;
        $tahun_ini = date('Y');
        $tahun_i = $tahun_ini+1;
        $ths = $tahun_sebelumnya.'/'.$tahun_ini;
        $thi = $tahun_ini.'/'.$tahun_i;
        $ruang = Ruang::findOrFail($id);
        for ($i=1; $i < 7 ; $i++) { 
            $data = DB::table('jadwals')
                    ->leftJoin('kelas', 'kelas.id', 'jadwals.kelas_id')
                    ->leftJoin('mata_kuliahs', 'mata_kuliahs.id', 'jadwals.matkul_id')
                    ->leftJoin('prodis', 'prodis.id', 'jadwals.prodi_id')
                    ->leftJoin('dosens', 'dosens.id', 'jadwals.dosen_id')
                    ->where('hari',$i)
                    ->whereBetween('tahun_ajaran', [$ths,$thi])
                    ->orderBy('tahun_ajaran')
                    ->select('jadwals.id', 'hari', 'jam_mulai', 'jam_selesai', 'mata_kuliahs.nama as matkul', 'kelas.kode as kelas', 'jadwals.semester as semester', 'jadwals.sks', 'dosens.nama as dosen', 'prodis.nama as prodi', 'keterangan')
                    ->where('jadwals.ruang_id', $id)
                    ->get();
                    

            $hasil[] = (object)[
                'hari' => dayFormatIndo($i),
                'data' => $data
            ];
        }

        // return $hasil;
        return view('home.detail', compact('hasil', 'ruang'));
    }
}
