@extends('layouts.app')
@section('title', 'Login')
@section('content')
    @component('components.alert') @endcomponent

    <h2 class="mt-3">Cadastro</h2>

    <form class="form-signin needs-validation mt-3" method="post" action="{{ route('register.do') }}" novalidate>
        @csrf
        <div class="form-floating mb-3">
            <input value="{{ old('name') }}" type="text" class="form-control" aria-describedby="name" name="name"
                id="name" placeholder="Nome" required>
            <label for="name">Nome completo</label>
            <div class="invalid-feedback">
                Nome inválido.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input value="{{ old('cpf') }}" class="form-control cpf" aria-describedby="cpf" name="cpf" id="cpf"
                placeholder="CPF" required>
            <label for="cpf">CPF</label>
            <div id="cpf" class="form-text">CPF meramente para nossa e sua proteção.</div>
            <div class="invalid-feedback">
                CPF inválido.
            </div>
        </div>
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
                placeholder="password" required>
            <label for="email">Senha</label>
            <div class="invalid-feedback">
                Senha inválido.
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Cadastrar</button>
    </form>
@endsection
@push('my-scripts')
    <script>
        $(document).ready(function() {
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_with_ddd').mask('(00) 0000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('.cpf').mask('000.000.000-00', {
                reverse: true
            });
            $('.cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
            $('.money').mask('000.000.000.000.000,00', {
                reverse: true
            });
            $('.money2').mask("#.##0,00", {
                reverse: true
            });
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/,
                        optional: true
                    }
                }
            });
            $('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {
                reverse: true
            });
            $('.clear-if-not-match').mask("00/00/0000", {
                clearIfNotMatch: true
            });
            $('.placeholder').mask("00/00/0000", {
                placeholder: "__/__/____"
            });
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
            });
            $('.selectonfocus').mask("00/00/0000", {
                selectOnFocus: true
            });
        });
    </script>
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
