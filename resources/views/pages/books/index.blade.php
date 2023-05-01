@extends('layouts.pages')

@section('pages_content')

@section('header', 'Books')

@if(Auth::user()->isStaff())
<a href="/books/create">Add a book</a>
@endif

<div>
Filter by category: 
<form action="/books" method="GET">
    <select name="category_filter">
        <option value="" selected>none</option>
        @foreach($categories as $category)
            <option value="{{$category->slug}}" {{ $category->slug === $selectedCategory ? 'selected' : '' }}>{{$category->title}}</option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
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
            <td><img src="{{asset($book->cover)}}" width=100></td>
            <td>{{$book->title}}</td>
            <td>{{$book->category->title}}</td>
            <td>{{$book->author}}</td>
            <td>{{$book->description}}</td>
            <td>{{$book->rating}}</td>
            <td>
                <a href="/books/{{$book->slug}}">View</a>
                @if(Auth::user()->isStaff()) 
                    <a href="/books/{{$book->slug}}/edit">Edit</a>
                    <button id="books-delete" attr-id="{{$book->slug}}">Delete</button>
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
