@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        @if(Auth::user()->isStaff())
        <nav class="navbar navbar-expand-lg">
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/books">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/staff">Staff</a>
                    </li>
                </ul>
            </div>
        </nav>
        @endif
    </div>

    <div class="col-md-6">
        <div class="d-flex justify-content-end align-items-center">
            <button id="logout">Logout</button>
        </div>
    </div>

    <div class="col-md-12 mt-1">
        <div class="card">
            <div class="card-header">@yield('header')</div>
            <div class="card-body">
                @yield('pages_content')
            </div>
        </div>
    </div>
</div>

@endsection