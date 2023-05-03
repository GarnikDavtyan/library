@extends('layouts.pages')

@section('pages_content')

@section('header', 'Edit A Category')

<form id="categories-edit">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{$category->title}}" required>
    <div id="title-error" class="field-error alert alert-danger d-none"></div>

    <input type="hidden" id="category-id" class="edit-slug" value="{{$category->slug}}">
    
    <button type="submit">Save</button>
</form>
<div class="success-response alert alert-success d-none"></div>
<div class="error-response alert alert-danger d-none"></div>

@endsection