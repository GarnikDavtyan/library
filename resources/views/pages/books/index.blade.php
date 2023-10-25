@extends('layouts.app')

@section('content')

@section('header', 'Books')

@if(Auth::user()->isStaff())
    <div class="row">
        <div class="col-md-6">
            <a href="/books/create">Add a book</a>
        </div>
        <div class="col-md-6">
            <form id="books-excel">
                <label for="excel" class="form-label">Import from excel</label>
                <input class="form-control" id="excel" type="file" name="excel" accept=".xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                <button type="submit" class="btn btn-warning mt-1">Upload</button>
            </form>
        </div>
    </div>
    <div class="success-response alert alert-success d-none mt-1"></div>
    <div class="error-response alert alert-danger d-none mt-1"></div>
    <div id="excel-error" class="field-error alert alert-danger d-none mt-1"></div>
    <hr>
@endif
<div class="d-flex align-items-center mb-1">
    <div class="me-1">
        Filter by category: 
    </div>
    <form action="/books" method="GET" class="d-flex align-items-center">
        <select name="category_filter" class="form-select me-1">
            <option value="" selected>none</option>
            @foreach($categories as $category)
                <option value="{{$category->slug}}" {{ $category->slug === $selectedCategory ? 'selected' : '' }}>{{$category->title}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-info">Filter</button>
    </form>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Description</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td><img src="{{$book->cover ? asset($book->cover) : asset('/storage/covers/default.png')}}" width=100 alt="{{ $book->title }}"></td>
            <td>{{$book->title}}</td>
            <td>{{$book->category->title}}</td>
            <td>{{$book->author}}</td>
            <td>{{$book->description}}</td>
            <td>{{$book->rating}}</td>
            <td>
                <a href="/books/{{$book->slug}}">View</a>
                @if(Auth::user()->isStaff()) 
                    <a href="/books/{{$book->slug}}/edit">Edit</a>
                    <button id="books-delete" class="btn btn-danger mt-1" attr-id="{{$book->slug}}">Delete</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex flex-column align-items-center ">
    {{ $books->links('pagination') }}
    <p class="text-center text-muted">
        Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
    </p>
</div>

@endsection
