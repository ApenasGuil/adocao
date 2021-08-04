@extends('layouts.app')
@section('title', 'DOAR')

@section('content')
    @component('components.alert') @endcomponent

    <h2 class="mt-3">Doar um bichinho</h2>

    <form class="form-signin mt-3" method="post" action="{{ route('register.do') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="Totó">
            <label for="name">Como se chama o nosso amiguinho(a)?</label>
        </div>
        <div class="mb-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="tipo">Tipo</label>
                </div>
                <select class="custom-select" id="tipo">
                    <option selected>...</option>
                    <option value="1">Doguinho</option>
                    <option value="2">Gatinho</option>
                    <option value="3">Passarinho</option>
                    <option value="4">Ratinho</option>
                    <option value="4">Réptilzinho</option>
                </select>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="breed" class="form-control" name="breed" id="breed" placeholder="RND">
            <label for="breed">Raça ('RND' para Raça Não Definida)</label>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Sexo</label><br>
            <input type="radio" id="html" name="fav_language" value="HTML">
            <label for="html">Macho</label><br>
            <input type="radio" id="css" name="fav_language" value="CSS">
            <label for="css">Fêmea</label><br>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="age" id="age" placeholder="3 meses">
            <label for="age">Idade aproximada (em meses)</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Muuuito brincalhão" name="bio" id="bio"></textarea>
            <label for="bio">Descreva brevemente como é o bicho</label>
        </div>
        <button type="submit" class="btn btn-dark">Doar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 2500);
        });
    </script>

@endsection
