@extends('layouts.master')

@section('content')
<form id="form-pengajuan">
    <div class="row">
        <div class="col-md-12">
            <h6>Data Peminjaman</h6>
            <button class="btn btn-info download-surat" type="button"><i class="fas fa-download"></i> Contoh Surat</button>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Peminjam</label>
                        <input type="text" class="form-control" readonly value="{{ auth()->user()->nama }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="ruang">
                        <label>Ruang</label>
                        <select name="ruang" class="form-control select2" style="width: 100%">
                            @foreach ($ruang as $item)
                            <optgroup label="{{ $item->posisi }}">
                                @foreach ($item->ruang as $value)
                                <option value="{{ $value->id }}">{{ $value->kode }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="tanggal_buat">
                        <label>Tanggal Dibuat</label>
                        <input type="text" class="form-control" readonly value="{{ date('d / m / Y') }}" name="tanggal_buat" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="form-group" id="perihal">
                        <label>Perihal</label>
                        <input type="text" class="form-control" name="perihal" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="agenda">
                        <label>Agenda</label>
                        <input type="text" class="form-control" name="agenda" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="tanggal">
                        <label>Tanggal Mulai s/d Selesai</label>
                        <input type="text" class="form-control date" name="tanggal">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="form-group" id="jumlah_orang">
                        <label>Jumlah Orang</label>
                        <input type="number" class="form-control" name="jumlah_orang">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Barang</label>
                        <div class="input-group input-group-lg">
                            
                            <select id="barang" class="form-control">
                                <option value="">--- Barang ---</option>
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success tambah-barang" type="button"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No WA Akademik</label>
                        <select id="no_wa" class="form-control">
                            @foreach($akademik as $a)
                            <option value="{{ $a->no_hp }}">{{ $a->nama.' / '.$a->no_hp }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-12 mt-5">
            <h6>Barang</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-barang">
                    
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-5">
            <button class="btn btn-primary float-right" type="submit">Ajukan</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $('.select2').select2({
        placeholder: "Ruang",
        allowClear: true
    });

    $(document).ready(function() {
        $('.date').daterangepicker({
            timePicker : true,
            timePicker24Hour : true,
            locale: {
                format : 'YYYY-MM-DD HH:mm'
            }
        });
    })

    $('.tambah-barang').on('click', function() {
        let id = $('#barang').val();
        let url = '{{ url('ajax/search_barang_id') }}'+'/'+id;
        
        let anjing = '';
        if ($('#list-'+id).length > 0) {
            errorMessage('Barang Sudah Dipinjam ');
        }
        else {
            let number = 1;
            $.get(url, function(result) {
                anjing += `
                    <tr id="list-${result.id}">
                        <input type="hidden" name="barang_id[]" value="${result.id}">
                        <td>${number++}</td>
                        <td>${result.nama_barang}</td>
                        <td style="width: 15%"><input type="number" class="form-control mt-2" value="1" min="1" max="${result.jumlah}" name="jumlah_pinjam[]"></td>
                        <td><button class="btn btn-danger hapus-barang mt-2" type="button" data-id="${result.id}"><i class="fas fa-times"></i></button></td>          
                    </tr>`;
                    $('#table-barang').append(anjing);
            });
        }
        
    })

    $('#form-pengajuan').on('submit', function(e) {
        e.preventDefault();
        let url = '{{ url('peminjam/pengajuan') }}';;
        let data = new FormData(this);
        let phone = $('#no_wa').val(); 
        $.ajax({
            async:true,
            type:'POST',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            url: url,
            data : data,
            beforeSend:function(request) {
                loading();
            },
            success: function(data){
                closeLoading();
                if (data.status == true) {
                    successMessage('Berhasil Mengajukan');
                    let wa = 'https://web.whatsapp.com/send';
                    let detail = '';
                    // let phone = '+6289662508343';
                    let ucapan = `Surat Izin Pengajuan peminjaman Ruang dari ${data.data.jabatan.jabatan}  dengan format: %0A%0A`;
                    let nama = `Nama : *${data.data.nama}* %0A%0A`;
                    let ruang = `Ruang : *${data.data.ruang.kode}* %0A%0A`;
                    let agenda = `Agenda : *${data.data.peminjaman.agenda}* %0A%0A`;
                    let tanggal = `Tanggal : *${data.data.tanggal}* %0A%0A`;
                    let jam = `Jam : *${data.data.waktu}*%0A%0A`;
                    let jumlah_orang = `Jumlah Orang : *${data.data.peminjaman.jumlah_orang} orang*%0A%0A`;
                    let barang = `Barang Dipinjam : %0A`;
                    console.log(data.data.detail);
                    $.each(data.data.detail, function(key, value) {
                        detail += `*${key+1}.${value.nama_barang} ${value.jumlah} unit*%0A`;
                    })
                    let via = `%0AVia : %0A{{ url('akademik/pengajuan/2') }}`;

                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                        wa = 'whatsapp://send';
                    }
                    let url_wa = wa + `?phone=${phone}&text=${ucapan}${nama}${ruang}${agenda}${tanggal}${jam}${jumlah_orang}${barang}${detail}${via}`;


                    let w = 960,
                        h = 540,
                        left = Number((screen.width / 2) - (w / 2)),
                        top = Number((screen.height / 2) - (h / 2)),
                        popupWindow = window.open(url_wa, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

                    popupWindow.focus();

                    window.location = '{{ url('peminjam/arsip-data') }}';
                }
                else {
                    errorMessage('Maaf Ruang Yang Anda Ajukan Saat ini Sedang Dipakai');
                }
                $('#modal-store').modal('hide');
                $('#table').DataTable().ajax.reload();
            },
            error: function (error) {
            closeLoading();
                var res = error.responseJSON;
                if (error.status == 422) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key)
                            .find('input')
                            .addClass('is-invalid').removeClass('is-valid');
                        $('#' + key)
                            .find('select')
                            .addClass('is-invalid').removeClass('is-valid');
                        $('#'+key).append(`<div class="invalid-feedback">${value}</div>`);
                    });
                }
                else {
                    errorMessage('Server Error');
                    $('#modal-store').modal('hide');
                }
            },
        })
    });

    $(document).on('click', '.hapus-barang', function() {
        let id = $(this).data('id');
        $('#list-'+id).remove();
        successMessage('Berhasil Hapus Brang');
    })

    $('.download-surat').on('click', function() {
        var win = window.open('{{ asset('surat-1.jpg') }}', '_blank');
        win.focus();
    })
</script>
@endpush