@extends('layouts.pages')

@section('pages_content')

@section('header', 'Add A Book')

<form id="books-create">
    <div class="d-flex flex-column">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <div id="title-error" class="field-error alert alert-danger d-none"></div>

        <label for="category">Category:</label>
        <select id="category" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <div id="category_id-error" class="field-error alert alert-danger d-none"></div>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <div id="author-error" class="field-error alert alert-danger d-none"></div>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description">
        <div id="description-error" class="field-error alert alert-danger d-none"></div>

        <label for="cover">Cover</label>
        <input id="cover" type="file" name="cover" accept="image/png, image/gif, image/jpeg">
        <div id="cover-error" class="field-error alert alert-danger d-none"></div>

        <button type="submit">Save</button>
    </div>
</form>
<div class="success-response alert alert-success d-none"></div>
<div class="error-response alert alert-danger d-none"></div>

@endsection