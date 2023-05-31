@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="section-title">{{ $ruang->kode }}</h2>
        <div class="row">
            
            <div class="col-md-12">
                <h5>Jadwal Pelajaran</h5>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>Prodi</th>
                            <th>Keterangan</th>
                        </tr>
                        @foreach ($hasil as $item)
                        @php
                        $count = count($item->data);
                        @endphp

                            @foreach ($item->data as $key=> $data)
                            <tr>
                                @if ($key == 0)
                                <td rowspan="{{ $count }}">{{ $item->hari }}</td>
                                @endif
                                <td>{{ $data->jam_mulai.' - '.$data->jam_selesai }}</td>
                                <td>{{ $data->kelas }}</td>
                                <td>{{ $data->matkul }}</td>
                                <td>{{ $data->semester }}</td>
                                <td>{{ $data->sks }}</td>
                                <td>{{ $data->dosen }}</td>
                                <td>{{ $data->prodi }}</td>
                                <td>{{ $data->keterangan }}</td>
                            </tr>
                            @endforeach

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection