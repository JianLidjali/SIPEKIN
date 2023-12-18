@extends('layouts.main')

@section('title', 'Employees')

@section('main')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Employees</h1>
        </div>
    </section>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Karyawan</h4>
                </div>
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('employee.update', $employee->uuid) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="name"
                                    class="mb-md-0 w-100 mb-2 text-start">Nama</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control @error('nama') border-danger @enderror" id="name"
                                    name="name" value="{{ $employee->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="staffIdentityCardNo"
                                    class="mb-md-0 w-100 mb-2 text-start">Staff Identity Card No</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text"
                                    class="form-control @error('staffIdetntityCardNo') border-danger @enderror"
                                    id="staffIdetntityCardNo" name="staffIdentityCardNo"
                                    value="{{ $employee->staffIdentityCardNo }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="department" class="mb-md-0 w-100 mb-2 text-start">
                                    Department</label></div>
                            <div class="col-12 col-md-9">
                                <select class="form-control w-100" name="department" id="department">
                                    <option value="Front office" {{ $employee->department =='Front
                                        office'
                                        ? 'selected' : ''
                                        }}>Front office</option>
                                    <option value="Housekeeping" {{ $employee->department == 'Housekeeping' ? 'selected'
                                        : ''
                                        }}>Housekeeping</option>
                                    <option value="Engineering" {{ $employee->department == 'Enginering' ? 'selected' :
                                        '' }}>Engineering</option>
                                    <option value="Accounting" {{ $employee->department == 'Accounting' ? 'selected' :
                                        ''}}>
                                        Accounting</option>
                                    <option value="Sales" {{ $employee->department == 'Sales' ? 'selected' : '' }}>Sales
                                    </option>
                                    <option value="FBS" {{ $employee->department == 'FBS' ? 'selected' : '' }}>FBS
                                    </option>
                                    <option value="FBP" {{ $employee->department == 'FBP' ? 'selected' : '' }}>FBP
                                    </option>
                                    <option value="HC & Security" {{ $employee->department == 'HC & Security' ?
                                        'selected' : '' }}>HC & Security</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="position"
                                    class="mb-md-0 w-100 mb-2 text-start">Posisi</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control @error('position') border-danger @enderror"
                                    id="position" name="position" value="{{ $employee->position }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="dateJoined"
                                    class="mb-md-0 w-100 mb-2 text-start">Date Joined</label></div>
                            <div class="col-12 col-md-9">
                                <input type="date" class="form-control @error('dateJoined') border-danger @enderror"
                                    id="dateJoined" name="dateJoined" value="{{ $employee->dateJoined }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="dateInThePresentPosition"
                                    class="mb-md-0 w-100 mb-2 text-start">Date In The Present Position</label></div>
                            <div class="col-12 col-md-9">
                                <input type="date"
                                    class="form-control @error('dateInThePresentPosition') border-danger @enderror"
                                    id="dateInThePresentPosition" name="dateInThePresentPosition"
                                    value="{{ $employee->dateInThePresentPosition }}">
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection