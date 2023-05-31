@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-book"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengajuan Hari ini</h4>
                </div>
                <div class="card-body">
                    {{ $hari_ini }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-book"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pengajuan</h4>
                </div>
                <div class="card-body">
                    {{ $total }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengajuan Disetujui</h4>
                </div>
                <div class="card-body">
                    {{ $setujui }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengajuan Ditolak</h4>
                </div>
                <div class="card-body">
                    {{ $tolak }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection