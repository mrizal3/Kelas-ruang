<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Jadwal;
use App\MataKuliah;
use App\Prodi;
use App\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{

    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = DB::table('jadwals')
            ->leftJoin('mata_kuliahs', 'mata_kuliahs.id', 'jadwals.matkul_id')
            ->leftJoin('prodis', 'prodis.id', 'jadwals.prodi_id')
            ->leftJoin('kelas', 'kelas.id', 'jadwals.kelas_id')
            ->leftJoin('ruangs', 'ruangs.id', 'jadwals.ruang_id')
            ->select('jadwals.id', 'mata_kuliahs.nama as matkul', 'kelas.kode as kelas', 'ruangs.kode as ruang', 'prodis.nama as prodi', 'jadwals.semester', 'jadwals.sks', 'hari', 'jam_mulai', 'jam_selesai', 'angkatan')
            ->get();

    return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jam', function($row){
                return $row->jam_mulai.' - '. $row->jam_selesai;
            })
            ->addColumn('hari', function($row) {
                return dayFormatIndo($row->hari);
            })
            ->rawColumns(['jam', 'hari'])
            ->make(true);
            
        }
        $matkul = MataKuliah::all();
        $ruang = Ruang::all();
        $prodi = Prodi::all();
        $ruang = Ruang::all();
        $dosen = Dosen::all();
        $hari = [
            ['id' => 1, 'nama' => 'Senin'],
            ['id' => 2, 'nama' => 'Selasa'],
            ['id' => 3, 'nama' => 'Rabu'],
            ['id' => 4, 'nama' => 'Kamis'],
            ['id' => 5, 'nama' => 'Jum\'at'],
            ['id' => 6, 'nama' => 'Sabtu'],
            ['id' => 7, 'nama' => 'Minggu'],
        ];

        return view('jadwal.index', compact('matkul', 'ruang', 'prodi', 'hari', 'ruang', 'dosen'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'prodi' => 'required',
            'kelas' => 'required',
            'matkul' => 'required',
            'ruang' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'semester' => 'required',
            'hari' => 'required',
            'sks' => 'required',
            'tahun_ajaran' => 'required',
            'dosen' => 'required',
        ]);
        $jam_mulai = explode(' ', $request->jam_mulai);
        $jam_selesai = explode(' ', $request->jam_selesai);

        $store = Jadwal::updateOrCreate(['id' => $request->id],[
            'prodi_id' => $request->prodi,
            'kelas_id' => $request->kelas,
            'matkul_id' => $request->matkul,
            'ruang_id' => $request->ruang,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'hari' => $request->hari,
            'jam_mulai' => $jam_mulai[0],
            'jam_selesai' => $jam_selesai[0],
            'keterangan' => $request->keterangan,
            'tahun_ajaran' => $request->tahun_ajaran,
            'angkatan' => $request->angkatan,
            'dosen_id' => $request->dosen
        ]);

        return setResponse($store);
    }

    public function edit($id)
    {
        return Jadwal::findOrFail($id);
    }

    public function destroy($id)
    {
        $search = Jadwal::findOrFail($id);

        if ($search->delete()) {
            return setResponse($search);
        }
    }
}