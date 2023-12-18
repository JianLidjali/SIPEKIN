@extends('layouts.main')

@section('title', 'Performance Appraisal Report')

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
            <h1>Performance Appraisal Report</h1>
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
                            <th>Department</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>
                                <a href="{{ route('annual.form', $employee->uuid) }}"
                                    class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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