    @extends('layouts.app')
    @section('title', 'Doar pet')

    @section('content')
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 mb-3">
                <h2 class="mt-3">Doar um bichinho</h2>
                @component('components.alert') @endcomponent

                <form enctype="multipart/form-data" class="form-signin needs-validation mt-3" method="post"
                    action="{{ route('pet.do') }}" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input value="{{ old('name') }}" type="text" class="form-control" aria-describedby="name"
                            name="name" id="name" placeholder="Totó" required>
                        <label for="name">Como se chama o nosso amiguinho(a)?</label>
                        <div class="invalid-feedback">
                            Nome do pet inválido.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="type">Tipo</label>
                            </div>
                            <select class="form-select" name="type" id="type" required>
                                <option value="" selected>...</option>
                                <option value="dog" @if (old('type') == 'dog') selected @endif>Doguinho</option>
                                <option value="cat" @if (old('type') == 'cat') selected @endif>Gatinho</option>
                                <option value="bird" @if (old('type') == 'bird') selected @endif>Passarinho</option>
                                <option value="mice" @if (old('type') == 'mice') selected @endif>Ratinho</option>
                                <option value="reptile" @if (old('type') == 'reptile') selected @endif>Réptilzinho</option>
                            </select>
                            <div class="invalid-feedback">
                                Escolha o tipo.
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input value="{{ old('breed') }}" type="breed" class="form-control" name="breed" id="breed"
                            placeholder="RND" required>
                        <label for="breed">Raça ('RND' para Raça Não Definida)</label>
                        <div class="invalid-feedback">
                            Raça inválida.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sexo</label><br>
                        <input class="form-check-input" @if (old('sex') == 'male') checked @endif type="radio" id="male" name="sex"
                            value="male" required>
                        <label for="male">Macho</label><br>
                        <input class="form-check-input" @if (old('sex') == 'female') checked @endif type="radio" id="female" name="sex"
                            value="female" required>
                        <label for="female">Fêmea</label><br>
                        <div class="invalid-feedback">
                            Escolha o gênero.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Idade do pet</label><br>
                        <div class="input-group mb-3">

                            <input value="{{ old('age') }}" type="number" class="form-control" name="age" id="age"
                                placeholder="2" required>
                            <select class="form-select" name="ageType" id="ageType" required>
                                <option value="" selected>...</option>
                                <option value="year" @if (old('ageType') == 'year') selected @endif>anos</option>
                                <option value="month" @if (old('ageType') == 'month') selected @endif>meses</option>
                            </select>
                            <div class="invalid-feedback">
                                Idade do pet inválida.
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input value="{{ old('bio') }}" type="text" class="form-control" name="bio" id="bio"
                            placeholder="Muuuito brincalhão" required>
                        <label for="bio">Breve descrição</label>
                        <div class="invalid-feedback">
                            Descrição inválida.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fotinha" class="form-label">Foto</label>
                        <input class="form-control" type="file" name="fotinha" id="fotinha">
                        <div class="invalid-feedback">
                            Foto inválida.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Doar</button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    @endsection
    @push('my-scripts')
        <script>
            $("document").ready(function() {
                setTimeout(function() {
                    $("div.alert").remove();
                }, 2500);
            });
        </script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
