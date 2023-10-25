@extends('layouts.app')

@section('content')

@section('header', 'Add A Book')

<form id="books-create">
    <label for="title" class="form-label">Title:</label>
    <input type="text" class="form-control" id="title" name="title" required>
    <div id="title-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="category" class="form-label mt-1">Category:</label>
    <select id="category" class="form-control" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>
    <div id="category_id-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="author" class="form-label mt-1">Author:</label>
    <input type="text" class="form-control" id="author" name="author" required>
    <div id="author-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="description" class="form-label mt-1">Description:</label>
    <input type="text" class="form-control" id="description" name="description">
    <div id="description-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="cover" class="form-label mt-1">Cover:</label>
    <input id="cover" class="form-control" type="file" name="cover" accept="image/png, image/gif, image/jpeg">
    <div id="cover-error" class="field-error alert alert-danger d-none mt-1"></div>

    <button type="submit" class="btn btn-success mt-1">Save</button>
</form>
<div class="success-response alert alert-success d-none mt-1"></div>
<div class="error-response alert alert-danger d-none mt-1"></div>

@endsection