<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Bootstrap Kit --}}
    <script src="https://kit.fontawesome.com/8c1e7e2148.js" crossorigin="anonymous"></script> {{-- FontAwesome --}}

    <title>{{ config('app.name') }} | @yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><strong>{{ config('app.name') }}</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('pets.index') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('pets.index') }}">Pets disponíveis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('users.index') }}">Usuários</a>
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
                            <li><a class="dropdown-item {{ Route::currentRouteNamed('#') ? 'active' : '' }}"
                                    href="#">Doar um pet</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled {{ Route::currentRouteNamed('#') ? 'active' : '' }}" href="#"
                            tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('#') ? 'active' : '' }}"
                                    aria-current="page"
                                    href="{{ route('user.show', ['user' => $user->id]) }}">FOTO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                    aria-current="page"
                                    href="{{ route('user.show', ['user' => $user->id]) }}">Nome de Usuário</a>
                            </li>
                        @endauth

                        @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('#') ? 'active' : '' }}"
                                aria-current="page"
                                href="{{ route('user.show', ['user' => $user->id]) }}">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                aria-current="page"
                                href="{{ route('user.show', ['user' => $user->id]) }}">Sign In</a>
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
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @yield('content')
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> {{-- Bootstrap JS --}}
</body>

</html>
