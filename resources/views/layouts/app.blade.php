<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    @guest
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        @if (Route::currentRouteName() === 'login')
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif

                        @if (Route::currentRouteName() === 'register')
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                    @else
                        @if(Auth::user()->isStaff())
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
                        @else
                            <a class="navbar-brand" href="/books">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        @endif
                            <div class="d-flex justify-content-end align-items-center">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                    @endguest
                </div>
            </nav>

            <main class="py-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">@yield('header')</div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</html>
