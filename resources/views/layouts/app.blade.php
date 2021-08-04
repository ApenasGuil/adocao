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

    {{-- <link rel="shortcut icon" href="{{ URL::to('../../img/proibidoEstacionar.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    @stack('my-styles')
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 2500);
        });
    </script>
    <script>
        $(document).ready(function() {
            var $modal = $('#modal_crop');
            var crop_image = document.getElementById('sample_image');
            var cropper;
            $('#upload_image').change(function(event) {
                var files = event.target.files;
                var done = function(url) {
                    crop_image.src = url;
                    $modal.modal('show');
                };
                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function(event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(crop_image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            $('#crop_and_upload').click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            url: 'crop_upload.php',
                            method: 'POST',
                            data: {
                                crop_image: base64data
                            },
                            success: function(data) {
                                $modal.modal('hide');
                            }
                        });
                    };
                });
            });
        });
    </script>
    <style>
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('login') }}"><strong>{{ config('app.name') }}</strong></a>
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
                                <li><a class="dropdown-item {{ Route::currentRouteNamed('pet.create') ? 'active' : '' }}"
                                        href="{{ route('pet.create') }}">Doar um pet</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth

                @guest
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">Quer doar um bichinho? Cadastre-se agora mesmo! É gratuito, rápido e fácil! <i class="pl-3 fas fa-paw"></i></a>
                        </li>
                    </ul>
                @endguest
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <img src="{{ asset('uploads/avatars/') }}/{{ Auth::user()->avatar }}"
                                    alt="user profile pic" id="user_pic_navbar">
                            </li>
                            <li class="nav-item">
                                {{-- <a class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('user.show', ['user' => $user->id]) }}">Nome de
                                    Usuário</a> --}}
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
                                    href="{{ route('logout') }}">Desconectar</a></li>
                        </ul>
                        </li>
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
    @stack('my-scripts')
</body>

</html>
