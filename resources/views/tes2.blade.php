@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Tes 
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-store" id="btn-add" data-backdrop="static" data-keyboard="false"><i class="far fa-paper-plane pr-2"></i> Tambah</button>
                <div class="table-responsive mt-5">
                </h3>
                    <table class="table table-bordered" id="table" style="width:100%">
                        <tr>
                            @foreach ($tes as $item)
                                
                            @endforeach
                        </tr>
                        @foreach ($tes as $item)
                        <tr>
                            <td>{{ $item['hari']  }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection