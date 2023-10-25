@extends('layouts.app')

@section('content')

@section('header', 'Edit A Staff Member')

<form id="staff-edit">
    <label for="title" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$staff->name}}" >
    <div id="name-error" class="field-error alert alert-danger d-none mt-1"></div>

    <input type="hidden" id="staff-id" value="{{$staff->id}}">
    
    <button type="submit" class="btn btn-success mt-1">Save</button>
</form>
<div class="success-response alert alert-success d-none mt-1"></div>
<div class="error-response alert alert-danger d-none mt-1"></div>

@endsection