@extends('layouts.pages')

@section('pages_content')

@section('header', 'Add A Staff Member')

<form id="staff-create">
    <label for="title">Name:</label>
    <input type="text" id="name" name="name" required>
    <div id="name-error" class="field-error alert alert-danger d-none"></div>

    <label for="title">Email:</label>
    <input type="email" id="email" name="email" required>
    <div id="email-error" class="field-error alert alert-danger d-none"></div>

    <label for="title">Password:</label>
    <input type="password" id="password" name="password" required>
    <div id="password-error" class="field-error alert alert-danger d-none"></div>
    
    <button type="submit">Save</button>
</form>
<div class="success-response alert alert-success d-none"></div>
<div class="error-response alert alert-danger d-none"></div>

@endsection