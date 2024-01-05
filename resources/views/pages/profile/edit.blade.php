<!-- resources/views/users/edit.blade.php -->

@extends('layouts.main')

@section('title', 'Edit User')

@section('main')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
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
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Information</h4>
                </div>
                <div class="card-body py-4-5 px-4">
                    <form action="{{ route('profile.update', $user->id) }}" method="post">
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
                            <div class="col-12 col-md-3"><label for="current_password"
                                    class="mb-md-0 w-100 mb-2 text-start">Current Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password"
                                    class="form-control @error('current_password') border-danger @enderror"
                                    id="current_password" name="current_password" required>
                                @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3"><label for="new_password"
                                    class="mb-md-0 w-100 mb-2 text-start">New Password</label></div>
                            <div class="col-12 col-md-9">
                                <input type="password"
                                    class="form-control @error('new_password') border-danger @enderror"
                                    id="new_password" name="new_password">
                                @error('new_password')
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
                                <div class="float-right">
                                    <a href="{{ route('password.request') }}" class="text-small">
                                        Forgot Password?
                                    </a>
                                </div>
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

@endsection