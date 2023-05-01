@extends('layouts.pages')

@section('pages_content')

@section('header', 'Categories')

<a href="/categories/create">Add a category</a>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->title}}</td>
                <td>
                    <a href="/categories/{{$category->slug}}/edit">Edit</a>
                    <button id="categories-delete" attr-id="{{$category->slug}}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    
@endsection
