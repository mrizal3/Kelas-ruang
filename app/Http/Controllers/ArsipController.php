<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Peminjaman;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('peminjamans')
                    ->leftJoin('users', 'users.id', 'peminjamans.user_id')
                    ->leftJoin('ruangs', 'ruangs.id', 'peminjamans.ruang_id')
                    ->select('peminjamans.id', 'users.nama as user', 'ruangs.kode as ruang', 'nomor', 'tanggal_dibuat', 'tanggal_mulai', 'tanggal_selesai', 'perihal', 'status')
                    ->where('peminjamans.user_id', auth()->user()->id)
                    ->get();
    
            return createTable($data);
        }
    
        return view('peminjam.arsip.index');
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->with([
            'detail_peminjaman' => function($query) {
                $query->with(['barang']);
            },
            'user', 'ruang'
        ])->firstOrFail();

        return view('peminjam.arsip.detail', compact('peminjaman'));
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
}
