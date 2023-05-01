@extends('layouts.pages')

@section('pages_content')

@section('header', 'Edit A Staff Member')

<form id="staff-edit">
    <label for="title">Name:</label>
    <input type="text" id="name" name="name" value="{{$staff->name}}" >
    <div id="name-error" class="field-error alert alert-danger d-none"></div>

    <input type="hidden" id="staff-id" value="{{$staff->id}}">
    
    <button type="submit">Save</button>
</form>
<div class="success-response alert alert-success d-none"></div>
<div class="error-response alert alert-danger d-none"></div>

@endsection