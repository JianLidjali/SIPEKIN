@extends('layouts.auth')

@section('title', 'Reset Password')

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Reset Password</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}"
                    required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection