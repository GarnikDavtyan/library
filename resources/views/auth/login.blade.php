@extends('layouts.app')

@section('content')

@section('header', 'Login')

<form id="login-form">
    <div class="form-group">
        <label for="email">Email</label>
        <div>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <div>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group">
        <div>
            <button type="submit" class="btn btn-primary mt-1">
                {{ __('Login') }}
            </button>
        </div>
    </div>
</form>
<div class="error-response alert alert-danger d-none"></div>

@endsection