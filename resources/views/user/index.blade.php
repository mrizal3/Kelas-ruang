@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>User 
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-store" id="btn-add" data-backdrop="static" data-keyboard="false"><i class="far fa-paper-plane pr-2"></i> Tambah</button>
                <div class="table-responsive mt-5">
                </h3>
                    <table class="table" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Jabatan</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Level</th>
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
@include('user.modal')
<script>
    const Table = () => {
        let form = $('#form-store');
        let table = 'table';
        let url = '{{ route('user.index') }}';
        let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama', name: 'nama'},
			{data: 'prodi', name: 'prodi'},
			{data: 'jabatan', name: 'jabatan'},
			{data: 'no_hp', name: 'no_hp'},
			{data: 'alamat', name: 'alamat'},
			{mData: 'level',render :function(data,type,row){
                if (data == 1) {
                    return 'Penyetuju';
                }
                else if(data == 2) {
                    return 'Peminjam';
                }
            }
            },
            {mData: 'id',render :function(data,type,row){
                return `
	                      <a href="#" class="aksi edit" data-id="${data}"><i class="fas fa-edit ac"></i> </a>
	                      <a href="#" class="aksi delete" data-id="${data}"><i class="fas fa-times ac"></i> </a>`; 
            }
            },
        ]

        generateTable(table,url,column);
    }

    Table();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#btn-add').on('click', function () { 
        $('#id').val('');
        removeValidation();
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#form-store').on('submit', function(e){
        e.preventDefault();
        removeAddValidation();
        let data = new FormData(this);
        let url = '{{ route('user.index') }}';
        storeData(data,url);
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.edit', function(e) {
        e.preventDefault();
        removeValidation();
        $('#modal-title').text('Edit user');
        let id = $(this).data('id');
        let url = '{{ route('user.index') }}'+'/'+id+'/edit';
        $.get(url, function(result) {
            $('#id').val(result.id);
            $.each(result,function(key,value) {
                $(`#${key} input[type="text"]`).val(value);
                $(`#${key} input[type="number"]`).val(value);
                $(`#${key} select`).val(value);
                $(`#${key} textarea`).val(value);
            })
            $('#prodi select').val(result.prodi_id)
            $('#jabatan select').val(result.jabatan_id)
            $('#tipe_identitas select').val(result.tipe_identitas)
        })
        $('#modal-store').modal('show');
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = '{{ route('user.index') }}'+'/'+id;
        let konfirmasi = confirm('Apakah kamu yakin ingin menghapus data Ini ?');
        if (konfirmasi == true) {
            deleteData(url);
        }
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
@endpush