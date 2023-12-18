@extends('layouts.main')

@section('title', 'Employees')

@push('style')

<style>
    /* Gaya untuk pagination dan show entries */
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        margin-top: 10px;
    }

    .dataTables_wrapper .dataTables_length {
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length label {
        font-weight: 600;
        margin-right: 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        width: 75px;
        padding: 6px;
        border-radius: 4px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin-right: 10px;
    }
</style>

@endpush
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
                <table class="table table-simple" id="table-employee">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Staff Identity Card No</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Date Joined</th>
                            <th>Date In The Present Position</th>
                            @if (Auth::user()->role != 'Karyawan' && Auth::user()->role != 'HOD')
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->staffIdentityCardNo }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->dateJoined }}</td>
                            <td>{{ $employee->dateInThePresentPosition }}</td>
                            @if (Auth::user()->role != 'Karyawan' && Auth::user()->role != 'HOD')
                            <td>
                                <a href="{{ route('employee.edit', $employee->uuid) }}" class="btn btn-warning"><i
                                        class="fa-solid fa-edit"></i></a>
                                <x-modal.delete :id="'deleteModal'.$employee->uuid"
                                    :route="route('employee.destroy', $employee->uuid)" :data="$employee->name"><i
                                        class="fa-solid fa-trash"></i></x-modal.delete>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <div class="flex mb-3">
                            @if (Auth::user()->role != 'Karyawan')
                            <a href="{{ route('employee.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus-circle"></i> Tambah</a>
                            @endif
                            <a href="{{ route('employee.export') }}" class="btn btn-info"><i
                                    class="fa-solid fa-file-export"></i> Export </a>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#table-employee').DataTable();
    });
</script>
@endpush

@endsection