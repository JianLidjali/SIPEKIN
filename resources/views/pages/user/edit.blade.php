<!-- resources/views/users/edit.blade.php -->

@extends('layouts.main')

@section('title', 'Edit User')

@section('main')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit User</h1>
        </div>
    </section>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Information</h4>
                </div>
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="username"
                                    class="mb-md-0 w-100 mb-2 text-start">Username</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control @error('username') border-danger @enderror"
                                    id="username" name="username" value="{{ $user->username }}" required>
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="email"
                                    class="mb-md-0 w-100 mb-2 text-start">Email</label></div>
                            <div class="col-12 col-md-9">
                                <input type="email" class="form-control @error('email') border-danger @enderror"
                                    id="email" name="email" value="{{ $user->email }}" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="role"
                                    class="mb-md-0 w-100 mb-2 text-start">Role</label></div>
                            <div class="col-12 col-md-9">
                                <select class="form-control w-100" name="role" id="role" required>

                                    <option value="HOD" {{ $user->role == 'HOD' ? 'selected' : '' }}>Head of Department
                                    </option>
                                    <option value="HRD" {{ $user->role == 'HRD' ? 'selected' : '' }}>HRD</option>
                                    <option value="GM" {{ $user->role == 'GM' ? 'selected' : '' }}>General Manager
                                    </option>
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div id="departmentRow" class="row mb-3" hidden>
                            <div class="col-12 col-md-3"><label for="department" class="mb-md-0 w-100 mb-2 text-start">
                                    Department</label></div>
                            <div class="col-12 col-md-9">
                                <select class="form-control w-100" name="department" id="department">
                                    <option value="Front office" {{ $user->department == 'Front office' ?
                                        'selected' : '' }}>Front office</option>
                                    <option value="Housekeeping" {{ $user->department == 'Housekeeping' ?
                                        'selected' : '' }}>Housekeeping</option>
                                    <option value="Engineering" {{ $user->department == 'Engineering' ?
                                        'selected' : '' }}>Engineering</option>
                                    <option value="Accounting" {{ $user->department == 'Accounting' ?
                                        'selected' : '' }}>Accounting</option>
                                    <option value="Sales" {{ $user->department == 'Sales' ? 'selected' : ''
                                        }}>Sales</option>
                                    <option value="FBS" {{ $user->department == 'FBS' ? 'selected' : '' }}>FBS
                                    </option>
                                    <option value="FBP" {{ $user->department == 'FBP' ? 'selected' : '' }}>FBP
                                    </option>
                                    <option value="HC & Security" {{ $user->department == 'HC & Security' ?
                                        'selected' : '' }}>HC & Security</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="password"
                                    class="mb-md-0 w-100 mb-2 text-start">Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password" class="form-control @error('password') border-danger @enderror"
                                    id="password" name="password">

                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">Note: Leave it blank if you don't want to change the
                                    password.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="password_confirmation"
                                    class="mb-md-0 w-100 mb-2 text-start">Confirm Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password"
                                    class="form-control @error('password_confirmation') border-danger @enderror"
                                    id="password_confirmation" name="password_confirmation">

                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
<!-- Tambahkan sebelum </body> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input Role dan Department
        var roleInput = document.getElementById('role');
        var departmentRow = document.getElementById('departmentRow');

        // Tambahkan event listener untuk perubahan pada input Role
        roleInput.addEventListener('change', function () {
            // Cek apakah Role yang dipilih adalah HOD
            if (roleInput.value === 'HOD') {
                // Tampilkan input Department
                departmentRow.removeAttribute('hidden');
            } else {
                // Sembunyikan input Department
                departmentRow.setAttribute('hidden', 'true');
            }
        });
    });
</script>
@endpush
@endsection