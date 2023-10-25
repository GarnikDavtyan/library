@extends('layouts.app')

@section('content')

@section('header', 'Add A Staff Member')

<form id="staff-create">
    <label for="title" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" name="name" required>
    <div id="name-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="title" class="form-label mt-1">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
    <div id="email-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="title" class="form-label mt-1">Password:</label>
    <input type="password" class="form-control" id="password" name="password" required>
    <div id="password-error" class="field-error alert alert-danger d-none mt-1"></div>
    
    <button type="submit" class="btn btn-success mt-1">Save</button>
</form>
<div class="success-response alert alert-success d-none mt-1"></div>
<div class="error-response alert alert-danger d-none mt-1"></div>

@endsection