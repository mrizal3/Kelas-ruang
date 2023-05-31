@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Jadwal Mata Kuliah
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-store"
                        id="btn-add" data-backdrop="static" data-keyboard="false"><i
                            class="far fa-paper-plane pr-2"></i> Tambah</button>
                    <div class="table-responsive mt-5">
                </h3>
                <table class="table table-bordered table-striped" style="border: 2px solid black;" id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prodi</th>
                            <th>Matkul</th>
                            <th>Kelas</th>
                            <th>Ruang</th>
                            <th>Semester</th>
                            <th>SKS</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
@include('jadwal.modal')
<script>
    $('.clockpicker').clockpicker();
    const Table = () => {
        let form = $('#form-store');
        let table = 'table';
        let url = '{{ route('jadwal.index') }}';
        let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'prodi', name: 'prodi'},
			{data: 'matkul', name: 'matkul'},
			{data: 'kelas', name: 'kelas'},
			{data: 'ruang', name: 'ruang'},
			{data: 'semester', name: 'semester'},
			{data: 'sks', name: 'sks'},
			{data: 'hari', name: 'hari'},
			{data: 'jam', name: 'jam'},
            {mData: 'id',render :function(data,type,row){
                return `
                <div class="dropdown d-inline">
                    <button class="btn btn-icon dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon edit" data-id="${data}"><i class="fas fa-edit"></i> Edit</a>
                        <a class="dropdown-item has-icon delete" data-id="${data}"><i class="fas fa-times"></i>  Delete</a>
                    </div>
                </div>`
            }
            },
        ]

        generateTable(table,url,column);
    }

    Table();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.prodi').on('change', function() {
    let id = $(this).val();
    getKelas(id) , getDosen(id)
})

$('#matkul select').on('change', function() {
    let id = $(this).val();
    let url = '{{ url('ajax/search_matkul') }}'+'/'+id;
    $.ajax({
        async:true,
        type:'GET',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        url: url,
        beforeSend:function(request) {
            loading();
        },
        success: function(data){
            closeLoading();
            if (data != null) {
                $('#sks input').val(data.sks);
                $('#semester input').val(data.semester);
            }
            else {
                $('#sks input').val('');
                $('#semester input').val('');
            }
        },
        error: function (error) {
            closeLoading();
        },
    })
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const getKelas = (id, kelas_id = null) => {
    let kelas = '<option value="">--- Kelas ---</option>';
    if (id !== '') {
        let url = '{{ url('ajax/search_kelas') }}'+'/'+id;
        $.ajax({
            async:true,
            type:'GET',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            url: url,
            beforeSend:function(request) {
                loading();
            },
            success: function(data){
                closeLoading();
                if (data != null) {
                    $.each(data, function(key,value) {
                        kelas += `<option value="${value.id}">${value.kode}</option>`;
                    })
                }
                $('.kelas').html(kelas)

                if (kelas_id != null) {
                    $('.kelas').val(kelas_id);
                }
            },
            error: function (error) {
            closeLoading();
            },
        })
    }
    else {
        $('.kelas').html(kelas)
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#btn-add').on('click', function () { 
        $('#id').val('');
        $('.kelas').html('');
        removeValidation();
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#form-store').on('submit', function(e){
        e.preventDefault();
        removeAddValidation();
        let data = new FormData(this);
        let url = '{{ route('jadwal.index') }}';
        storeData(data,url);
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.edit', function(e) {
        e.preventDefault();
        removeValidation();
        $('.kelas').html('');
        $('#modal-title').text('Edit Jadwal');
        let id = $(this).data('id');
        let url = '{{ route('jadwal.index') }}'+'/'+id+'/edit';
        $.get(url, function(result) {
            $('#id').val(result.id);
            $.each(result,function(key,value) {
                $(`#${key} input[type="text"]`).val(value);
                $(`#${key} input[type="number"]`).val(value);
                $(`#${key} select`).val(value);
                $(`#${key} textarea`).val(value);
            })
            $('#matkul select').val(result.matkul_id)
            $('#dosen select').val(result.dosen_id)
            $('#ruang select').val(result.ruang_id)
            $('#prodi select').val(result.prodi_id);
            getKelas(result.prodi_id, result.kelas_id);
            $('#jam_mulai input').val(result.jam_mulai);
            $('#jam_selesai input').val(result.jam_selesai);
        })
        $('#modal-store').modal('show');
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = '{{ route('jadwal.index') }}'+'/'+id;
        let konfirmasi = confirm('Apakah kamu yakin ingin mengahpus data Ini ?');
        if (konfirmasi == true) {
            deleteData(url);
        }
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
@endpush