@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Kelas 
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-store" id="btn-add" data-backdrop="static" data-keyboard="false"><i class="far fa-paper-plane pr-2"></i> Tambah</button>
                <div class="table-responsive mt-5">
                </h3>
                    <table class="table" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Prodi</th>
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
@include('kelas.modal')
<script>
    const Table = () => {
        let id = '{{ getUri(3) }}';
        let form = $('#form-store');
        let table = 'table';
        let url = '{{ route('kelas.index') }}'+'/'+id;
        let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'kode', name: 'kode'},
			{data: 'prodi.nama', name: 'prodi.nama'},
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
        let url = '{{ route('kelas.store') }}';
        storeData(data,url);
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.edit', function(e) {
        e.preventDefault();
        removeValidation();
        $('#modal-title').text('Edit Kelas');
        let id = $(this).data('id');
        let url = '{{ route('kelas.store') }}'+'/'+id+'/edit';
        editData(url);
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#table').on('click', '.delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = '{{ route('kelas.store') }}'+'/'+id;
        let konfirmasi = confirm('Apakah kamu yakin ingin menghapus data Ini ?');
        if (konfirmasi == true) {
            deleteData(url);
        }
    })
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
@endpush