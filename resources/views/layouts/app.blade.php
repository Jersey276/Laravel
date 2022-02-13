<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tristan Lefèvre</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
        @yield('scripts')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            @if(Auth::user() && Auth::user()->rules('admin_panel'))
                <a class="btn btn-primary float-left" data-bs-toggle="offcanvas" href="#adminOffCanvas" role="button" aria-controls="adminOffCanvas">
                    Admin
                </a>
            @endif
            <div class="container">
                <img src="{{ asset('img/profile.webp')}}" alt="image tristan" style="width:80px; height:80px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Tristan Lefèvre
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('postList')}}">{{__('Posts')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projectList')}}">{{__('Projects')}}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/users/{{ Auth::user()->name }}">
                                        {{ __('My Profile')}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div id="app">
            @if (session('status-type') && session('status-message'))
                <div class="alert alert-{{session('status-type')}}" role="alert" style="z-index: 980">
                    {{ session('status-message') }}
                </div>
            @endif
            <main class="py-4 container">
                @yield('content')
            </main>
        </div>
        @if(Auth::user() && Auth::user()->rules('admin_panel'))
            <x:panel.base/>
        @endif
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <ul class="nav justify-content-center pb-3 mb-3">
                    <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">{{__('home')}}</a></li>
                    <li class="nav-item"><a href="/ugc" class="nav-link px-2 text-muted">{{__('UGC')}}</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link px-2 text-muted">{{__('Contact')}}</a></li>
                    <li class="nav-item"><a href="/about" class="nav-link px-2 text-muted">{{__('About')}}</a></li>
                </ul>
                <div class="d-flex justify-content-between py-2 border-top">
                    <p>© 2021 Tristan</p>
                    <ul class="list-unstyled d-flex">
                        <li class="ms-3">
                            <a class="text-linkedin" href="https://www.linkedin.com/in/tristan-lef%C3%A8vre-100b40139/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                </svg>
                            </a>
                        </li>
                        <li class="ms-3 me-3"><a class="text-github" href="https://github.com/Jersey276">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                        </a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
