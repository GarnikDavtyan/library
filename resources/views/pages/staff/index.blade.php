@extends('layouts.pages')

@section('pages_content')

@section('header', 'Staff')

<a href="/staff/create">Add a staff member</a>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($staff as $member)
            <tr>
                <td>{{$member->name}}</td>
                <td>{{$member->email}}</td>
                <td>
                    <a href="/staff/{{$member->id}}/edit">Edit</a>
                    <button id="staff-delete" attr-id="{{$member->id}}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
@endsection
