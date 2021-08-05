@extends('layouts.app')
@section('title', 'DOAR')

@section('content')
    @component('components.alert') @endcomponent

    <h2 class="mt-3">Doar um bichinho</h2>

    <form class="form-signin mt-3" method="post" action="{{ route('pet.do') }}">
        @csrf
        <div class="form-floating mb-3">
            <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Totó">
            <label for="name">Como se chama o nosso amiguinho(a)?</label>
        </div>
        <div class="mb-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="type">Tipo</label>
                </div>
                <select class="custom-select" name="type" id="type">
                    <option value="" selected>...</option>
                    <option value="dog" @if (old('type') == 'dog') selected @endif>Doguinho</option>
                    <option value="cat" @if (old('type') == 'cat') selected @endif>Gatinho</option>
                    <option value="bird" @if (old('type') == 'bird') selected @endif>Passarinho</option>
                    <option value="mice" @if (old('type') == 'mice') selected @endif>Ratinho</option>
                    <option value="reptile" @if (old('type') == 'reptile') selected @endif>Réptilzinho</option>
                </select>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input value="{{ old('breed') }}" type="breed" class="form-control" name="breed" id="breed" placeholder="RND">
            <label for="breed">Raça ('RND' para Raça Não Definida)</label>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Sexo</label><br>
            <input @if (old('sex') == 'male') checked @endif type="radio" id="male" name="sex" value="male">
            <label for="male">Macho</label><br>
            <input @if (old('sex') == 'female') checked @endif type="radio" id="female" name="sex" value="female">
            <label for="female">Fêmea</label><br>
        </div>
        <div class="form-floating mb-3">
            <input value="{{ old('age') }}" type="number" class="form-control" name="age" id="age" placeholder="3 meses">
            <label for="age">Idade aproximada (em meses)</label>
        </div>
        <div class="form-floating mb-3">
            <input value="{{ old('bio') }}" type="text" class="form-control" name="bio" id="bio"
                placeholder="Muuuito brincalhão">
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
