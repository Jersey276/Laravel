<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tristan Lefèvre</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            @if(Auth::user() && Auth::user()->rules('admin_panel'))
                <a class="btn btn-primary float-left" data-bs-toggle="offcanvas" href="#adminOffCanvas" role="button" aria-controls="offcanvasExample">
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
        <div class="offcanvas offcanvas-start" id="adminOffCanvas">
            <div class="offcanvas-header">
                <h2>Admin</h2>
            </div>
            <div class="offcanvas-body w-100 h-100 px-0">
                <div class="accordion px-0" id="admin-offcanvas-accordion">
                    @if (Auth::user()->rules('user_admin'))
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false" aria-controls="user-collapse"> 
                                Utilisateur
                            </button>
                            <ul id="user-collapse" class="accordion-collapse collapse list-group-flush mb-0" data-bs-parent="#admin-offcanvas-accordion">
                                <li class="list-group-item">
                                    <a class="link-dark" href="/admin/users">Lister les utilisateurs</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if (Auth::user()->rules('post_crud'))
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#post-collapse"  aria-expanded="false" aria-controls="post-collapse"> 
                                Articles
                            </button>
                            <ul id="post-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                                <li class="list-group-item">
                                    <a class="link-dark" href="/admin/posts">Lister les articles</a>
                                </li>
                                <li class="list-group-item">
                                    <a class="link-dark" href="/admin/posts/add">Créer un article</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if (Auth::user()->rules('project_crud'))
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#project-collapse"  aria-expanded="false" aria-controls="project-collapse">
                            Projets
                        </button>
                        <ul id="project-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/projects">Lister les projets</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/projects/add">Créer un projet</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @if(Auth::user()->rules('cv_crud'))
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cv-collapse"  aria-expanded="false" aria-controls="cv-collapse">
                            CV
                        </button>
                        <ul id="cv-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/cv">Gérer les éléments du cv</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/cv/exp">Gérer les expériences</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/cv/knowledge">Gérer les compétences</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/cv/courses">Gérer les formations</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/cv/languages">Gérer les langues</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#admin-collapse"  aria-expanded="false" aria-controls="admin-collapse"> 
                            Options d'administrations
                        </button>
                        <ul id="admin-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                            @if(Auth::user()->rules('moderation'))
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/log">gérer les journaux</a>
                            </li>
                            @endif
                            @if(Auth::user()->rules('moderation'))
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/users/banlist">Lister les utilisateurs bannis</a>
                            </li>
                            @endif
                            @if(Auth::user()->rules('roles_crud'))
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/roles">Lister les roles</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/roles/add">Ajouter un role</a>
                            </li>
                            @endif
                            @if(Auth::user()->rules('rules_admin'))
                            <li class="list-group-item">
                                <a class="link-dark" href="/admin/rules">Lister les règles</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>
</html>
