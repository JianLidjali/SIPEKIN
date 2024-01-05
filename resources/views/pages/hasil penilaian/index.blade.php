@extends('layouts.main')

@section('title', 'Semua Penilaian')
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
            <h1>Semua Penilaian</h1>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable" id="table-appraisal">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Karyawan</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appraisals as $index => $appraisal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $appraisal->employee->name }}</td>
                                    <td>{{ $appraisal->status }}</td>
                                    <td>{{ $appraisal->type }}</td>
                                    <td>{{ date('d F Y', strtotime($appraisal->date)) }}</td>
                                    <td>
                                        @if($appraisal->status == 'Diapprove oleh HRD' || $appraisal->status == 'Diapprove oleh GM')
                                        <form action="{{ route('appraisal.print', $appraisal->id) }}" method="post"
                                            style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Cetak</button>
                                        </form>
                                        @else
                                        <button type="submit" class="btn btn-secondary" disabled>Cetak</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script>
    $(document).ready(function () {
        $('#table-appraisal').DataTable();
    });
</script>
@endpush
@endsection