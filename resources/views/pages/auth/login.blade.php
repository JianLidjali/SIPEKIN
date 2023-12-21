@extends('layouts.auth')
@section('title', 'Login')

@section('main')

<x-main.alert />
@if (session()->has('status'))
<div class="alert alert-info alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        {{ session('status') }}
    </div>
</div>

@endif
<div class="card card-primary">
    <div class="card-header " style="text-align: center">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('auth.login') }}" class="needs-validation">
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
                    <div class="float-right">
                        <a href="{{ route('password.request') }}" class="text-small">
                            Forgot Password?
                        </a>
                    </div>
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