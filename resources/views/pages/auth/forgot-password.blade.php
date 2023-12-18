@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Forgot Password</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                    autofocus>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection