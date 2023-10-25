@extends('layouts.app')

@section('content')

@section('header', 'Add A Category')

<form id="categories-create">
    <label for="title" class="form-label">Title:</label>
    <input type="text" class="form-control" id="title" name="title" required>
    <div id="title-error" class="field-error alert alert-danger d-none mt-1"></div>
    
    <button type="submit" class="btn btn-success mt-1">Save</button>
</form>
<div class="success-response alert alert-success d-none mt-1"></div>
<div class="error-response alert alert-danger d-none mt-1"></div>

@endsection