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
                    <h4>Tambah Karyawan</h4>
                </div>
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('employee.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="name"
                                    class="mb-md-0 w-100 mb-2 text-start">Nama</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control @error('nama') border-danger @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="staffIdentityCardNo"
                                    class="mb-md-0 w-100 mb-2 text-start">Staff Identity Card No</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text"
                                    class="form-control @error('staffIdetntityCardNo') border-danger @enderror"
                                    id="staffIdetntityCardNo" name="staffIdetntityCardNo"
                                    value="{{ old('staffIdetntityCardNo') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="department" class="mb-md-0 w-100 mb-2 text-start">
                                    Department</label></div>
                            <div class="col-12 col-md-9">
                                <select class="form-control w-100" name="department" id="department">
                                    <option value="Front office" {{ old('department'=='Front office' ? 'selected' : '' )
                                        }}>Front office</option>
                                    <option value="Housekeeping" {{ old('department'=='Housekeeping' ? 'selected' : '' )
                                        }}>Housekeeping</option>
                                    <option value="Engineering" {{ old('department'=='Engineering' ? 'selected' : '' )
                                        }}>Engineering</option>
                                    <option value="Accounting" {{ old('department'=='Accounting' ? 'selected' : '' ) }}>
                                        Accounting</option>
                                    <option value="Sales" {{ old('department'=='Sales' ? 'selected' : '' ) }}>Sales
                                    </option>
                                    <option value="FBS" {{ old('department'=='FBS' ? 'selected' : '' ) }}>FBS</option>
                                    <option value="FBP" {{ old('department'=='FBP' ? 'selected' : '' ) }}>FBP</option>
                                    <option value="HC & Security" {{ old('department'=='HC & Security' ? 'selected' : ''
                                        ) }}>HC & Security</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="position"
                                    class="mb-md-0 w-100 mb-2 text-start">Posisi</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control @error('position') border-danger @enderror"
                                    id="position" name="position" value="{{ old('position') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="dateJoined"
                                    class="mb-md-0 w-100 mb-2 text-start">Date Joined</label></div>
                            <div class="col-12 col-md-9">
                                <input type="date" class="form-control @error('dateJoined') border-danger @enderror"
                                    id="dateJoined" name="dateJoined" value="{{ old('dateJoined') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="dateInThePresentPosition"
                                    class="mb-md-0 w-100 mb-2 text-start">Date In The Present Position</label></div>
                            <div class="col-12 col-md-9">
                                <input type="date"
                                    class="form-control @error('dateInThePresentPosition') border-danger @enderror"
                                    id="dateInThePresentPosition" name="dateInThePresentPosition"
                                    value="{{ old('dateInThePresentPosition') }}">
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