<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RuangRepository;
use App\Ruang;
use Illuminate\Support\Facades\DB;
class RuangController extends Controller
{
    protected $ruang;

    public function __construct(RuangRepository $ruang)
    {
        $this->ruang = $ruang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->ruang->generateTable();
        }
        return view('ruang.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->ruang->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->ruang->edit($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->ruang->delete($id);
    }

    public function user_detail($id)
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
                    ->select('jadwals.id', 'hari', 'jam_mulai', 'jam_selesai', 'mata_kuliahs.nama as matkul', 'kelas.kode as kelas', 'mata_kuliahs.semester as semester', 'mata_kuliahs.sks', 'dosens.nama as dosen', 'prodis.nama as prodi', 'keterangan')
                    ->where('jadwals.ruang_id', $id)
                    ->get();
                    

            $hasil[] = (object)[
                'hari' => dayFormatIndo($i),
                'data' => $data
            ];
        }

        // return $hasil;
        return view('peminjam.ruang.index', compact('hasil', 'ruang'));
    }
}
