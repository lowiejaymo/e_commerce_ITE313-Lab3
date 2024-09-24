<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('LuxeLine.LuxeLine', 'LuxeLine') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvas-confetti/1.4.0/confetti.browser.min.js"></script>


    <style>
        .card-link {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card-link:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .falling-image {
            position: absolute;
            width: 100px;
            height: auto;
            animation: fall 2s forwards;
        }

        @keyframes fall {
            0% {
                top: -150px;
                opacity: 1;
            }

            100% {
                top: 80%;
                opacity: 0;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/luxeline-dark.png') }}" alt="LuxeLine"
                        style="height: 40px; width: auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <img src="{{ asset('storage/user_profile_pictures/' . Auth::user()->profile_picture) }}"
                                        alt="Profile Picture" class="rounded-circle me-2"
                                        style="width: 30px; height: 30px; object-fit: cover;">
                                    <span>Hello, {{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        Profile
                                    </a>
                                    @if(Auth::user()->userRole->role_id == 1)
                                        <a class="dropdown-item" href="{{ route('products.index') }}">
                                            Manage Products
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.manageUsers') }}">
                                            Manage Users
                                        </a>
                                        <a class="dropdown-item" href="{{ route('categories.index') }}">
                                            Manage Categories
                                        </a>
                                        <a class="dropdown-item" href="{{ route('suppliers.index') }}">
                                            Manage Suppliers
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-2 mt-2 ms-5">
                    @yield('sidebar')
                </div>

                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>

</html>