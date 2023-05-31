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
                            <div class="invoice-number">Nomor : <input type="text" class="form-control nomor" name="nomor" value="{{ $peminjaman->nomor }}" autocomplete="off"></div>
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
            <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                    @if ($peminjaman->status == 0)
                    <button class="btn btn-success btn-icon icon-left setuju"><i class="fas fa-check"></i> Setujui</button>
                    <button class="btn btn-danger btn-icon icon-left btn-tolak"><i class="fas fa-times"></i> Tolak</button>
                    @elseif($peminjaman->status == 1)
                    <button class="btn btn-danger btn-icon icon-left btn-tolak"><i class="fas fa-times"></i> Tolak</button>
                    @else
                    <button class="btn btn-success btn-icon icon-left setuju"><i class="fas fa-check"></i> Setujui</button>
                    @endif
                    
                </div>
                <a href="{{ url('akademik/pengajuan').'/'.getUri(3) }}/surat" class="btn btn-info btn-icon icon-left"><i class="fas fa-print"></i> Print Surat</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@include('akademik.pengajuan.modal')
<script>
    let url = '{{ url('akademik/pengajuan/ubah_status') }}';
    let id = '{{ getUri(3) }}';
    $('.nomor').on('change', function() {
        let nomor = $(this).val();
        let status = 'nomor';

        $.post(url, {nomor:nomor, status:status, id:id}, function(result) {
            if (result.status == true) {
                successMessage('Berhasil Isi Nomor');
            }
            else {
                errorMessage('Gagal Mengisi Nomor !');
            }
        })
    })

    $('.setuju').on('click', function() {
        let status = 'setuju';
        let konfir = confirm('Apakah Yakin Menyetujui Pengajuan ini ?');
        if (konfir == true) {
            $.post(url, {status:status, id:id}, function(result) {
                if (result.status == true) {
                    successMessage('Pengajuan Disetujui');
                    setTimeout(function() {
                        window.location = '{{ url('akademik/pengajuan') }}';
                    },2000)
                }
                else {
                    errorMessage('Pengajuan Gagal Disetujui');
                }
            })
        }

    });

    $('.btn-tolak').on('click', function() {
        $('.keterangan').val('');
        $('.modal-tolak').modal('show');
    });

    $('.tolak').on('click', function() {
        let keterangan = $('.keterangan').val();
        let status = 'tolak';
        $.post(url, {status:status, id:id, keterangan:keterangan}, function(result) {
            if (result.status == true) {
                successMessage('Pengajuan Ditolak');
                setTimeout(function() {
                    window.location = '{{ url('akademik/pengajuan') }}';
                },2000)
            }
            else {
                errorMessage('Pengajuan Gagal Ditolak');
            }
            $('.modal-tolak').modal('hide');
        })
    })
</script>
@endpush