@extends('layouts.app')
@section('title', 'Lista de pets')

@section('content')
    <div class="row mb-3">
        @component('components.alert') @endcomponent
        @forelse ( $pets as $pet)
            <div class="col-md-4">
                <div class="card-columns-fluid d-flex justify-content-center mt-3">
                    <div class="card " style="width: 18rem;">
                        <img style="min-width: 25px; max-width: 350px; height: 200px" class="card-img-top"
                            src="{{ asset($pet->pegaimg()) }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i style="color: {{ $pet->get_color_sex() }}" class="fs-4 {{ $pet->get_icon() }}"></i>
                                {{ $pet->name }}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $pet->created_at }}</h6>
                            <p class="card-text">{{ $pet->bio }}</p>
                            <p class="card-text"><small class="text-muted">{{ $pet->user->name }}</small></p>
                            <a href="{{ route('pet.show', ['pet' => $pet->id]) }}" class="btn btn-primary">Ver mais
                                dessa
                                fofura</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="mt-3">Nenhum pet cadastrado. <a style="text-decoration:none;color:rgb(255, 174, 0)"
                    href="{{ route('pet.create') }}"><strong>Doe um pet</strong></a> agora mesmo! :)</p>
        @endforelse
    </div>

















    {{-- <div class="container-fluid">
    <div class="row">
        @forelse ($pets as $pet)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset($pet->pegaimg()) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <i style="color: {{ $pet->get_sex() }}" class="fs-4 {{ $pet->get_icon() }}"></i>
                        {{ $pet->name }}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $pet->created_at }}</h6>
                    <p class="card-text">{{ $pet->bio }}</p>
                    <p class="card-text"><small class="text-muted">{{ $pet->user->name }}</small></p>
                    <a href="{{ route('pet.show', ['pet' => $pet->id]) }}" class="btn btn-primary">Ver mais dessa
                        fofura</a>
                </div>
            </div>
            @empty
            <tr>
                <td>No pets added.</td>
            </tr>
        @endforelse
    </div>
</div> --}}


    {{-- <div class="container-fluid">


    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Type</th>
                <th scope="col">Breed</th>
                <th scope="col">User</th>
                <th class="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pets as $pet)
                <tr>
                    <th scope="row">{{ $pet->id }}</th>
                    <td>{{ $pet->name }}</td>
                    <td>
                        @if ($pet->sex === 0)
                            Fêmea
                        @elseif ($pet->sex === 1)
                            Macho
                        @endif
                    </td>
                    <td>
                        @if ($pet->type === 'Gato' && $pet->sex === 0)
                            <i style="color: pink" class="fs-2 fas fa-cat"></i>
                        @elseif ($pet->type === 'Gato' && $pet->sex === 1)
                            <i style="color: blue" class="fs-2 fas fa-cat"></i>
                        @elseif ($pet->type === 'Cão' && $pet->sex === 0)
                            <i style="color: pink" class="fs-2 fas fa-dog"></i>
                        @elseif ($pet->type === 'Cão' && $pet->sex === 1)
                            <i style="color: blue" class="fs-2 fas fa-dog"></i>
                        @endif
                    </td>
                    <td>{{ $pet->breed }}</td>
                    <td><a href="{{ route('user.show', ['user' => $pet->user->id]) }}">{{ $pet->user->name }}</a>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a class="btn btn-outline-primary" href="{{ route('pet.show', ['pet' => $pet->id]) }}"
                                role="button"><i class="fas fa-info"></i></a>
                            <a class="btn btn-outline-warning" href="{{ route('pet.edit', ['pet' => $pet->id]) }}"
                                role="button"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-danger"
                                onclick="return confirm('Deseja mesmo deletar esse petzinho?')"
                                href="{{ route('pet.destroy', $pet->id) }}"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" >Nenhum pet cadastrado. <a style="text-decoration:none;color:rgb(255, 174, 0)" href="{{ route('pet.create') }}"><strong>Doe um pet</strong></a> agora mesmo! :)</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> --}}

@endsection
@push('my-scripts')
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 2500);
        });
    </script>
@endpush
