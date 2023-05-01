@extends('layouts.pages')

@section('pages_content')

@section('header', 'Add A Category')

<form id="categories-create">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <div id="title-error" class="field-error alert alert-danger d-none"></div>
    
    <button type="submit">Save</button>
</form>
<div class="success-response alert alert-success d-none"></div>
<div class="error-response alert alert-danger d-none"></div>

@endsection