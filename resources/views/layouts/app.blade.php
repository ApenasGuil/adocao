<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Bootstrap CSS --}}
    <script src="https://kit.fontawesome.com/8c1e7e2148.js" crossorigin="anonymous"></script> {{-- FontAwesome --}}

    {{-- <link rel="shortcut icon" href="{{ URL::to('../../img/proibidoEstacionar.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <script src="{{ asset('js/jQuery-Mask-Plugin-master/src/jquery.mask.js') }}"></script>
    @stack('my-styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><strong>{{ config('app.name') }}</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('pets.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('pets.index') }}">Pets disponíveis</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pets
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item {{ Route::currentRouteNamed('pets.index') ? 'active' : '' }}"
                                        href="#">Cãezinhos</a></li>
                                <li><a class="dropdown-item {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                        href="#">Gatinhos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item {{ Route::currentRouteNamed('pet.create') ? 'active' : '' }}"
                                        href="{{ route('pet.create') }}">Doar um pet</a></li>
                            </ul>
                        </li>
                        @if (Auth::user()->is_admin())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                            href="{{ route('users.index') }}">Usuários</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                @endauth

                @guest
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">Quer doar um bichinho?
                                <span style="color:rgb(255, 174, 0)">Cadastre-se</span> agora mesmo! É gratuito, rápido e
                                fácil! <span style="color:rgb(255, 174, 0)"><i class="pl-3 fas fa-paw"></i></span></a>
                        </li>
                    </ul>
                @endguest
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <img class="" src="{{ Auth::user()->get_avatar() }}" alt="user profile pic"
                                    id="user_pic_navbar">
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item {{ Route::currentRouteNamed('user.show') ? 'active' : '' }}"
                                            href="{{ route('user.show', ['user' => Auth::user()->id]) }}">Perfil</a></li>
                                    <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item {{ Route::currentRouteNamed('#') ? 'active' : '' }}"
                                    href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Desconectar</a></li>
                        </ul>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('register') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('register') }}">Sign
                                Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('login') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('login') }}">Sign
                                In</a>
                        </li>
                    @endguest
                    </ul>
                    {{-- <input class="form-control me-2" type="search" placeholder="Pesquisar um pet" aria-label="Search">
                    <button class="btn btn-light" type="submit">Ir</button> --}}
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('content')
    </div>
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @yield('content')
            </div>
            <div class="col-md-1"></div>
        </div>
    </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @stack('my-scripts')
</body>

</html>
