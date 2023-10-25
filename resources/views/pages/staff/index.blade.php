@extends('layouts.app')

@section('content')

@section('header', 'Staff')

<a href="/staff/create">Add a staff member</a>
<hr>
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
                    <button id="staff-delete" class="btn btn-danger ms-1" attr-id="{{$member->id}}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
@endsection
