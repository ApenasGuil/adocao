@extends('layouts.app')
@section('title', 'Login')
@section('content')

    @component('components.alert') @endcomponent

    <h2 class="mt-3">Entrar</h2>

    <form class="form-signin needs-validation mt-3" method="post" action="{{ route('login.do') }}" novalidate>
        @csrf

        <div class="form-floating mb-3">
            <input value="{{ old('email') }}" type="email" class="form-control" aria-describedby="email" name="email"
                id="email" placeholder="E-mail" required>
            <label for="email">E-mail</label>
            <div class="invalid-feedback">
                E-mail inválido.
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" aria-describedby="password" name="password" id="password"
                placeholder="Senha" required>
            <label for="password">Senha</label>
            <div class="invalid-feedback">
                Senha inválida.
            </div>
        </div>

        <button type="submit" class="btn btn-dark">Entrar</button>
    </form>
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
