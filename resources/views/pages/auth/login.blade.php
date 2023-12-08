@extends('layouts.auth')
@section('title', 'Login')

@section('main')

<x-main.alert />
<div class="card card-primary">
    <div class="card-header " style="text-align: center">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('auth.login') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid 
                    
                @enderror" name="username" tabindex="1" required autofocus value="{{ old('username') }}">
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your Username
                </div>
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

@endsection