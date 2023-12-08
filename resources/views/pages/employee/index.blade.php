@extends('layouts.main')

@section('title', 'Employees')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Employees</h1>
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
        @endif
    </section>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped-columns table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Staff Identity Card No</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Date Joined</th>
                            <th>Date In The Present Position</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $karyawan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $karyawan->name }}</td>
                            <td>{{ $karyawan->staffIdentityCardNo }}</td>
                            <td>{{ $karyawan->department }}</td>
                            <td>{{ $karyawan->position }}</td>
                            <td>{{ $karyawan->dateJoined }}</td>
                            <td>{{ $karyawan->dateInThePresentPosition }}</td>
                            <td>
                                <a href="" class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <a href="" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <div class="flex mb-3">
                            <a href="{{ route('employee.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus-circle"></i> Tambah</a>
                            <a href="" class="btn btn-info"><i class="fa-solid fa-file-export"></i> Export </a>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection