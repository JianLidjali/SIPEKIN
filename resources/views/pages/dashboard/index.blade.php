@extends('layouts.main')

@section('title', 'Dashboard')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
    </section>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Department</h4>
                    </div>
                    <div class="card-body">
                        1
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Karyawan</h4>
                    </div>
                    <div class="card-body">
                        1
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Dipertahankan</h4>
                    </div>
                    <div class="card-body">
                        1
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-times-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Tidak Dipertahankan</h4>
                    </div>
                    <div class="card-body">
                        2
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body col-12">
        </div>
    </div>
</div>


@endsection