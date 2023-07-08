<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <section style="width:100%;">
            <header class="ms-0 ps-0 pt-0 border">
                <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                @guest
                                @else
                                @if(Auth::user()->permission == 1)
                                <li>
                                    <span
                                        style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li class="my-auto px-3">
                                    <p class="m-auto">ADMINISTRATOR</p>
                                </li>
                                <li>
                                    <span style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Permissions</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Teachers</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Students</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Classes</a>
                                </li>
                                @endif
                                @if(Auth::user()->permission == 2)
                                <li>
                                    <span
                                        style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li class="my-auto px-3">
                                    <p class="m-auto">TEACHER</p>
                                </li>
                                <li>
                                    <span style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Students</a>
                                </li>
                                @endif
                                @if(Auth::user()->permission == 3)
                                <li>
                                    <span
                                        style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li class="my-auto px-3">
                                    <p class="m-auto">STUDENT</p>
                                </li>
                                <li>
                                    <span style="display: inline-block; width:1px; height:90%; background:#000; margin: 0 2px;"></span>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Score</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">Classes</a>
                                </li>
                                @endif
                                @endguest
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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <section style="background-color: #f4f6f9; height:88vh" class="m-0">
                <main class="p-4">
                    @yield('content')
                </main>
            </section>
            <footer>
                <div class=" border d-flex justify-content-between align-items-center m-0 p-0">
                    <p class="my-3 ps-2">Created by <span><a
                                href=" https://github.com/MTristan012">MTristan012</a></span></p>
                    <p class="my-3 pe-2">Anything you want</p>
                </div>
            </footer>
        </section>
    </div>
</body>

</html>