@extends('layouts.app')

@section('content')

@section('header', 'Edit The Book')

<form id="books-edit">
@method('PUT')
    <label for="title" class="form-label">Title:</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$book->title}}" required>
    <div id="title-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="category" class="form-label mt-1">Category:</label>
    <select id="category" class="form-control" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{$category->id}}" {{ $book->category->id === $category->id ? 'selected' : '' }}>{{$category->title}}</option>
        @endforeach
    </select>
    <div id="category_id-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="author" class="form-label mt-1">Author:</label>
    <input type="text" class="form-control" id="author" name="author" value="{{$book->author}}" required>
    <div id="author-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="description" class="form-label mt-1">Description:</label>
    <input type="text" class="form-control" id="description" name="description" value="{{$book->description}}">
    <div id="description-error" class="field-error alert alert-danger d-none mt-1"></div>

    <label for="cover" class="form-label mt-1">Cover:</label>
    <input id="cover" class="form-control my-1" type="file" name="cover" accept="image/png, image/gif, image/jpeg">
    <div><img src="{{$book->cover ? asset($book->cover) : asset('/storage/covers/default.png')}}" alt="{{$book->title}}" width="300"></div>
    <div id="cover-error" class="field-error alert alert-danger d-none mt-1"></div>

    <input type="hidden" id="book-id" class="edit-slug" value="{{$book->slug}}">

    <button type="submit" class="btn btn-success mt-1">Save</button>
</form>
<div class="success-response alert alert-success d-none mt-1"></div>
<div class="error-response alert alert-danger d-none mt-1"></div>

@endsection