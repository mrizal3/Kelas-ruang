@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>User</h4>
                </div>
                <div class="card-body">
                    {{ $user }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Dosen</h4>
                </div>
                <div class="card-body">
                    {{ $dosen }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-th-large"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Ruang</h4>
                </div>
                <div class="card-body">
                    {{ $ruang }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Barang</h4>
                </div>
                <div class="card-body">
                    {{ $barang }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection