@extends('layouts.app')

@section('content')

@section('header', 'Register')

<form id="register-form">
    <div class="form-group">
        <label for="name">Name</label>
        <div>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>
    </div>
    <div id="name-error" class="field-error alert alert-danger d-none"></div>

    <div class="form-group">
        <label for="email">Email</label>
        <div>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
    </div>
    <div id="email-error" class="field-error alert alert-danger d-none"></div>

    <div class="form-group">
        <label for="password">Password</label>
        <div>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>
    <div id="password-error" class="field-error alert alert-danger d-none"></div>

    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div>
        <button type="submit" class="btn btn-primary mt-1">
            {{ __('Register') }}
        </button>
        </div>
    </div>
</form>
<div class="error-response alert alert-danger d-none"></div>

@endsection