@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Pengajuan</h2>
                            <div class="invoice-number">Nomor : {{ $peminjaman->nomor }}</div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-striped">
                            <tr>
                                <td>Perihal : {{ $peminjaman->perihal }}</td>
                            </tr>
                            <tr>
                                <td>Agenda : {{ $peminjaman->agenda }}</td>
                            </tr>
                            <tr>
                                <td>Ruang : {{ $peminjaman->ruang->kode }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Orang : {{ $peminjaman->jumlah_orang }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-striped">
                            <tr>
                                <td>Peminjam : {{ $peminjaman->user->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Dibuat : {{ formatDate2($peminjaman->tanggal_dibuat) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pelaksaan : {{ formatDate2($peminjaman->tanggal_mulai) }} - {{ formatDate2($peminjaman->tanggal_selesai) }}</td>
                            </tr>
                            @if ($peminjaman->status == 2)
                            <tr>
                                <td>Alasan Ditolak</td>
                                <td>{{ $peminjaman->keterangan }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
        
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Detail Pengajuan</div>
                        {{-- <p class="section-lead">All items here cannot be deleted.</p> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                <tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($peminjaman->detail_peminjaman as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                    @endforelse
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if ($peminjaman->status != 0)
            <div class="text-md-right">
                <a href="{{ url('peminjam/arsip-data').'/'.getUri(3) }}/surat" class="btn btn-success btn-icon icon-left"><i class="fas fa-print"></i> Print Surat</a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection