@extends('layouts.app')

@section('content')

@section('header', $book->title)

<div>
    <div>
        <img src="{{$book->cover ? asset($book->cover) : asset('/storage/covers/default.png')}}" alt="{{ $book->title }}" width="300">
    </div>
    <div>
        <p><strong>Category:</strong> {{ $book->category->title }}</p>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Description:</strong> {{ $book->description }}</p>
        <p><strong>Rating:</strong> {{ $book->rating }}</p>
    </div>
    @if(count($book->comments))
        <h5>Comments</h5>
        @foreach($book->comments as $comment)
            <p><strong>{{$comment->user->name}}: </strong>{{$comment->text}}</p>
        @endforeach
    @endif
    @if(Auth::user()->isVisitor())
        <form id="comment">
            <input type="text" class="form-control" name="comment" required>
            <input type="hidden" id="book-comment-id" value="{{$book->slug}}">

            <button type="submit" class="btn btn-primary mt-1">Add comment</button>
        </form>
    @endif 
</div>

@endsection