<?php

namespace App\Http\Controllers;

use App\Barang;
use App\DetailPeminjaman;
use App\Jadwal;
use App\Peminjaman;
use Illuminate\Http\Request;
use App\Ruang;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function index()
    {
        $pending = Peminjaman::limit(1)->orderBy('tanggal_dibuat', 'DESC')->where('status', 0)->where('user_id', getUser()->id)->get();
        $akademik = User::where('level', 1)->select('no_hp', 'nama')->get();
        if (count($pending)  != true) {
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

            $barang = Barang::all();

            return view('peminjam.pengajuan.index', compact('ruang', 'barang', 'akademik'));    
        }

        abort(403, 'Kamu masih punya pengajuan yang masih belum diproses !');

        
    }

    public function store(Request $request)
    {

        $tanggal = explode(' - ', $request->tanggal);
        $ambilTanggal1 = explode(' ', $tanggal[0]);
        $ambilTanggal2 = explode(' ', $tanggal[1]);
        $ambilJamMulai = $ambilTanggal1[1].':00';
        $ambilJamSelesai = $ambilTanggal2[1].':00';


        $b = [];
        $request->validate([
            'ruang' => 'required',
            'perihal' => 'required',
            'agenda' => 'required',
            'tanggal' => 'required',
            'jumlah_orang' => 'required'
        ]);

        return $checkHari = checkHari($ambilTanggal1[0]);
        // $checkRuang = Ruang::where('maksimal', '>', $request->jumlah_orang)->get();
        $checkJadwal = Jadwal::where('hari', $checkHari)
                        ->where('ruang_id', $request->ruang)
                        ->where('jam_mulai', '>=', $ambilJamMulai)
                        ->where('jam_selesai', '<=', $ambilJamSelesai)
                        ->get();

        if (count($checkJadwal) > 0) {
            return response()->json([
                'status' => false
            ]);
        }
        else {
            $store = Peminjaman::create([
                'user_id' => auth()->user()->id,
                'ruang_id' => $request->ruang,
                'perihal' => $request->perihal,
                'tanggal_dibuat' => Carbon::now(),
                'tanggal_mulai' => $tanggal[0].':00',
                'tanggal_selesai' => $tanggal[1].':00',
                'status' => 0,
                'jumlah_orang' => $request->jumlah_orang,
                'agenda' => $request->agenda,
            ]);
            
            $jabatan = DB::table('users')
                        ->leftJoin('jabatans', 'jabatans.id', 'users.jabatan_id')
                        ->where('users.id', $store->user_id)
                        ->select('jabatans.nama as jabatan')
                        ->first();
            
            $ruang = Ruang::select('kode')->find($store->ruang_id);

            if (formatDate3($store->tanggal_mulai) != formatDate3($store->tanggal_selesai)) {
                $tanggal = formatDate($store->tanggal_mulai).' s/d '.formatDate($store->tanggal_selesai);
            }
            else {
                $tanggal = formatDate($store->tanggal_mulai);
            }

            $waktu = timeFormat($store->tanggal_mulai).' s/d '.timeFormat($store->tanggal_selesai);

            if ($store) {
                if($request->barang_id != null) {
                    foreach ($request->barang_id as $key => $value) {
                        $detail[] = [
                            'peminjaman_id' => $store->id,
                            'barang_id' => $value,
                            'jumlah' => $request->jumlah_pinjam[$key]
                        ];
                        $barang = Barang::select('nama_barang')->find($value);
                        $b[] = (object)[
                            'nama_barang' => $barang->nama_barang,
                            'jumlah' => $request->jumlah_pinjam[$key]
                        ];
                    }
                    DetailPeminjaman::insert($detail);
                    
                }
                return response()->json([
                    'status' => true,
                    'data' => (object)[
                        'peminjaman' => $store,
                        'detail' => $b,
                        'ruang' => $ruang,
                        'jabatan' => $jabatan,
                        'nama' => auth()->user()->nama,
                        'tanggal' => $tanggal,
                        'waktu' => $waktu,
                    ]
                ]);
            }    
        }

        
    }

    public function akademik(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('peminjamans')
                    ->leftJoin('users', 'users.id', 'peminjamans.user_id')
                    ->leftJoin('ruangs', 'ruangs.id', 'peminjamans.ruang_id')
                    ->select('peminjamans.id', 'users.nama as user', 'ruangs.kode as ruang', 'nomor', 'tanggal_dibuat', 'tanggal_mulai', 'tanggal_selesai', 'perihal', 'status')
                    ->get();

            return createTable($data);
        }

        return view('akademik.pengajuan.index');
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->with([
            'detail_peminjaman' => function($query) {
                $query->with(['barang']);
            },
            'user', 'ruang'
        ])->firstOrFail();

        return view('akademik.pengajuan.detail', compact('peminjaman'));
    }

    public function surat($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->with([
            'detail_peminjaman' => function($query) {
                $query->with(['barang']);
            },
            'user' => function($query){
            $query->with('jabatan');
            }, 'ruang'
        ])->firstOrFail();

        $lampiran = DB::table('detail_peminjamans')
                    ->leftJoin('barangs', 'barangs.id', 'detail_peminjamans.barang_id')
                    ->where('peminjaman_id', $id)
                    ->select('barangs.nama_barang as barang', 'detail_peminjamans.jumlah as jumlah')
                    ->get();

        if ($peminjaman->status == 1) {
            $document = file_get_contents("surat-setuju.rtf");
        }
        elseif($peminjaman->status == 2) {
            $document = file_get_contents("surat-tolak.rtf");
        }
        else {
            abort('404');
        }
 
        $document = str_replace("[PERIHAL]", $peminjaman->perihal, $document);
        $document = str_replace("[NOMOR]", $peminjaman->nomor, $document);
        $document = str_replace("[KEPADA]", $peminjaman->user->jabatan->nama, $document);
        $document = str_replace("[TANGGAL_BUAT]", formatDate4($peminjaman->tanggal_buat), $document);
        if (formatDate3($peminjaman->tanggal_mulai) != formatDate3($peminjaman->tanggal_selesai)) {
            $tanggal = formatDate($peminjaman->tanggal_mulai).' s/d '.formatDate($peminjaman->tanggal_selesai);
        }
        else {
            $tanggal = formatDate($peminjaman->tanggal_mulai);
        }

        for ($i=0; $i < 9; $i++) { 
            
            if (isset($lampiran[$i])) {
                $j = $i+1;
                $document = str_replace("[BARANG".$j."]", $lampiran[$i]->barang, $document);
                $document = str_replace("[JUMLAH".$j."]", $lampiran[$i]->jumlah, $document);
            }
            else {
                $j = $i+1;
                $document = str_replace("[BARANG".$j."]", '', $document);
                $document = str_replace("[JUMLAH".$j."]", '', $document);
            }
        }

        $waktu = timeFormat($peminjaman->tanggal_mulai).' s/d '.timeFormat($peminjaman->tanggal_selesai);

        $document = str_replace("[TANGGAL_PELAKSANAAN]", $tanggal, $document);
        $document = str_replace("[WAKTU_PELAKSANAAN]", $waktu, $document);
        $document = str_replace("[RUANG]", $peminjaman->ruang->kode.' '.$peminjaman->ruang->posisi, $document);
        $document = str_replace("[AGENDA]", $peminjaman->agenda, $document);
        
        // header untuk membuka file output RTF dengan MS. Word
        // nama file output adalah undangan.rtf
        
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=surat.rtf");
        header("Content-length: " . strlen($document));
        echo $document;
    }

    public function lampiran($id)
    {
        
    }

    public function ubah_status(Request $request)
    {
        $pengajuan = Peminjaman::where('id', $request->id);
        $detail_pengajuan = DetailPeminjaman::where('peminjaman_id', $request->id)->get();
        if ($request->status == 'nomor') {
            $pengajuan->update([
                'nomor' => $request->nomor
            ]);
        }
        elseif($request->status == 'setuju') {
            $pengajuan->update([
                'status' => 1,
            ]);

            foreach ($detail_pengajuan as $value) {
                $barang = Barang::where('id', $value->barang_id)->decrement('jumlah', $value->jumlah);
            }
        }
        else{
            $pengajuan->update([
                'status' => 2,
                'keterangan' => $request->keterangan
            ]);
        }

        return setResponse($pengajuan);

    }
}
