@extends('layouts.main')

@section('title', 'Users Management')

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
            <h1>Users Management</h1>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning"><i
                                        class="fa-solid fa-pencil"></i></a>
                                <x-modal.delete :id="'deleteModal'.$user->id" :route="route('user.destroy', $user->id)"
                                    :data="$user->name"><i class="fa-solid fa-trash"></i></x-modal.delete>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <div class="flex mb-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Tambah</a>
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