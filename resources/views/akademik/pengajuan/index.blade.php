@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Pengajuan
                <div class="table-responsive mt-5">
                </h3>
                    <table class="table" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomor</th>
                                <th>Perihal</th>
                                <th>Peminjam</th>
                                <th>Ruang</th>
                                <th>Tanggal Dibuat</th>
                                <th>Status</th>
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
<script>
    const Table = () => {
        let table = 'table';
        let url = '{{ url('akademik/pengajuan') }}';
        let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor', name: 'nomor'},
            {data: 'perihal', name: 'perihal'},
            {data: 'user', name: 'user'},
            {data: 'ruang', name: 'ruang'},
            {mData: 'tanggal',render :function(data,type,row){
                return moment(data).format('D/MM/YYYY');
            }
            },
            
            {mData: 'status',render :function(data,type,row){
                if (data == 0) {
                    return '<span class="badge badge-info">Pending</span>';
                }
                else if(data == 1) {
                    return '<span class="badge badge-success">Disetujui</span>';
                }
                else {
                    return '<span class="badge badge-danger">Ditolak</span>';
                }
            }
            },
            {mData: 'id',render :function(data,type,row){
                return `
	                      <a href="{{ url('akademik/pengajuan/${data}') }}" class="aksi"><i class="fas fa-search ac"></i> </a>`;
            }
            }
        ];

        generateTable(table,url,column);
    }

    Table();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
@endpush