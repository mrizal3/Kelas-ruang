@extends('layouts.master')

@section('content')
<div class="row">
    @foreach ($ruang as $item)
    <div class="col-md-12">
        <h2 class="section-title">{{ $item->posisi }}</h2>
        <div class="row">
            @foreach ($item->ruang as $value)
            <div class="col-md-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h4>{{ $value->kode }}</h4><br>
                    </div>
                    <div class="card-body">
                        <p>Maksimal : {{ $value->maksimal }} orang</p>
                        <p>Keterangan :</p>
                        <p>{{ $value->keterangan }}</p>
                        <a href="{{ url('peminjam/ruang').'/'.$value->id }}" class="btn btn-info float-right">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection