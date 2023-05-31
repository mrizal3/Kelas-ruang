@extends('layouts.master2')

@section('content')
<form method="GET">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Prodi</label>
                <select name="prodi" class="form-control prodi">
                    <option value="">--- Prodi ---</option>
                    @foreach ($prodi as $item)
                    <option value="{{ $item->id }}" {{ $item->id == request()->get('prodi') ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" class="form-control kelas"></select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="angkatan">
                <label>Angkatan</label>
                <select name="angkatan" class="form-control validation angkatan">
                    <option value="">Angkatan</option>
                    @for ($i = -5; $i < 5; $i++) <option value="{{ date('Y')+$i }}">{{ date('Y')+$i }}</option>
                        @endfor
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="margin-top:1.9rem !important">
                <button class="btn btn-success"><i class="fas fa-search"></i> Filter</button>
                <button class="btn btn-info" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</form>
<div class="row" id="printableArea">
    <table class="table table-bordered table-striped" >
        <tr>
            <th>Hari</th>
            <th>Jam</th>
            <th>Ruang</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Dosen</th>
            <th>Prodi</th>
            <th>Keterangan</th>
        </tr>
        @forelse ($data_jadwal as $item)
        @php
        $count = count($item->data);
        @endphp

            @forelse ($item->data as $key=> $data)
            <tr>
                @if ($key == 0)
                <td rowspan="{{ $count }}">{{ $item->hari }}</td>
                @endif
                <td width="15%">{{ date('H:i', strtotime($data->jam_mulai)).' - '.date('H:i', strtotime($data->jam_selesai)) }}</td>
                <td>{{ $data->ruang }}</td>
                <td>{{ $data->matkul.'/'.$data->semester.$data->kelas }}</td>
                <td>{{ $data->sks }}</td>
                <td>{{ $data->dosen }}</td>
                <td>{{ $data->prodi }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
            @empty
            
            @endforelse
        @empty

        @endforelse
    </table>
</div>
@endsection

@push('scripts')
<script>
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
                @if(request()->get('kelas') != null)
                    $('.kelas').val({{ request()->get('kelas') }}).attr('selected', true);
                @endif
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

    $('.prodi').on('change', function() {
        let id = $(this).val();
        getKelas(id)
    })
    
    @if(request()->get('prodi') != null)
        getKelas({{ request()->get('prodi') }})
    
    @endif


    @if(request()->get('angkatan') != null)
        $('.angkatan').val({{ request()->get('angkatan') }});
    
    @endif

    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    
</script>
@endpush