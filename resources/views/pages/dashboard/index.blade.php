@extends('layouts.main')

@section('title', 'Dashboard')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
        @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('error') }}
            </div>
        </div>
        @elseif (Auth::user()->role == 'Karyawan' && $appraisal->where('status', 'pending')->count() > 0)
        <div class="alert alert-warning alert-dismissible show fade">
            <div class="alert-body">

                Anda memiliki penilaian yang belum diisi. Mohon segera melengkapi penilaian Anda.
                <ul>
                    @foreach ($appraisal->where('status', 'pending') as $pendingAppraisal)
                    <li>{{ $pendingAppraisal->type }} - {{ $pendingAppraisal->employee->name }}</li>
                    @endforeach
                </ul>
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        </div>
        @endif
    </section>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Department</h4>
                    </div>
                    <div class="card-body">
                        {{ $department }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Karyawan</h4>
                    </div>
                    <div class="card-body">
                        {{ $employee }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Penilaian For Annual Dibuat</h4>
                    </div>
                    <div class="card-body">
                        {{ $data2 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Penilaian For Probation Dibuat</h4>
                    </div>
                    <div class="card-body">
                        {{ $data3 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Penilaian For Promotion Dibuat</h4>
                    </div>
                    <div class="card-body">
                        {{ $data4 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'HOD' && $appraisal->whereIn('status', ['pending', 'Diisi oleh Karyawan'])->count() > 0)
    <div class="card">
        <div class="card-body col-12">
            <div class="card col-12 mt-3">
                <div class="card-header">
                    <h4>Daftar Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>Nama Karyawan</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Detail</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appraisal as $index => $appraisal)
                                @if($appraisal->status != 'Diapprove oleh HOD' && $appraisal->status != 'Diapprove oleh
                                HRD' && $appraisal->status != 'Diapprove oleh GM')
                                <tr>

                                    <td>{{ $appraisal->employee->name }}</td>
                                    <td>{{ $appraisal->status }}</td>
                                    <td>{{ $appraisal->type }}</td>
                                    <td>
                                        <a href="{{ route('appraisal.show', $appraisal->id) }}"
                                            class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($appraisal->status == 'Diisi oleh Karyawan')
                                        <form action="{{ route('hod.approve', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('reject', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                        @else
                                        <button class="btn">
                                            <span class="badge badge-secondary">Belum diisi Karyawan</span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif (Auth::user()->role == 'HRD' && $appraisal->where('status', 'Diapprove oleh HOD')->count() > 0)
    <div class="card">
        <div class="card-body col-12">
            <div class="card col-12 mt-3">
                <div class="card-header">
                    <h4>Daftar Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>Nama Karyawan</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Detail</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appraisal as $index => $appraisal)
                                @if($appraisal->status != 'Diapprove oleh HRD' && $appraisal->status != 'Diapprove oleh
                                GM' && $appraisal->status != 'pending' && $appraisal->status != 'Diisi oleh Karyawan')
                                <tr>
                                    <td>{{ $appraisal->employee->name }}</td>
                                    <td>{{ $appraisal->status }}</td>
                                    <td>{{ $appraisal->type }}</td>
                                    <td>
                                        <a href="{{ route('appraisal.show', $appraisal->id) }}"
                                            class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($appraisal->status == 'Diapprove oleh HOD')
                                        <form action="{{ route('hrd.approve', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('reject', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                        @else
                                        <button class="btn">
                                            <span class="badge badge-secondary">Belum diisi Karyawan</span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif (Auth::user()->role == 'GM' && $appraisal->where('status', 'Diapprove oleh HRD')->count() > 0)
    <div class="card">
        <div class="card-body col-12">
            <div class="card col-12 mt-3">
                <div class="card-header">
                    <h4>Daftar Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>Nama Karyawan</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Detail</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appraisal as $index => $appraisal)
                                @if($appraisal->status != 'Diapprove oleh GM' && $appraisal->status != 'pending' &&
                                $appraisal->status != 'Diisi oleh Karyawan')
                                <tr>

                                    <td>{{ $appraisal->employee->name }}</td>
                                    <td>{{ $appraisal->status }}</td>
                                    <td>{{ $appraisal->type }}</td>
                                    <td>
                                        <a href="{{ route('appraisal.show', $appraisal->id) }}"
                                            class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($appraisal->status == 'Diapprove oleh HRD')
                                        <form action="{{ route('gm.approve', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('reject', $appraisal->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                        @else
                                        <button class="btn">
                                            <span class="badge badge-secondary">Belum diisi Karyawan</span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

</div>



@endsection