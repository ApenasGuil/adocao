@extends('layouts.app')
@section('title', 'Lista de pets')
@section('content')
    @component('components.alert') @endcomponent
    <h1>User: Lista de pets</h1>

    <div class="row">
        @foreach ($pets as $pet)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('uploads/avatars/') }}/default/default.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">
                        @if ($pet->type === 'cat' && $pet->sex === 0)
                            <i style="color: pink" class="fs-4 fas fa-cat"></i>
                        @elseif ($pet->type === 'cat' && $pet->sex === 1)
                            <i style="color: blue" class="fs-4 fas fa-cat"></i>
                        @elseif ($pet->type === 'dog' && $pet->sex === 0)
                            <i style="color: pink" class="fs-4 fas fa-dog"></i>
                        @elseif ($pet->type === 'dog' && $pet->sex === 1)
                            <i style="color: blue" class="fs-4 fas fa-dog"></i>
                        @endif {{ $pet->name }}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $pet->created_at }}</h6>
                    <p class="card-text">{{ $pet->bio }}</p>
                    <p class="card-text"><small class="text-muted">{{ $pet->user->name }}</small></p>
                    <a href="{{ route('pet.show', ['pet' => $pet->id]) }}" class="btn btn-primary">Ver mais dessa
                        fofura</a>
                </div>
            </div>
        @endforeach
    </div>




    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        </div>
    </div>

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
            @foreach ($pets as $pet)
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
                    <td><a href="{{ route('user.show', ['user' => $pet->user->id]) }}">{{ $pet->user->name }}</a></td>
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
            @endforeach
        </tbody>
    </table>




@endsection


{{-- @extends('layout.master-layout')
@section('title', 'PETS')

@section('content')
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do pet</th>
                <th scope="col">Idade</th>
                <th scope="col">Tipo</th>
                <th scope="col">Raça</th>
                <th scope="col">Sexooooo ( ͡° ͜ʖ ͡°)</th>
                <th scope="col">Pertence à</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <th scope="row">{{ $pet->id }}</th>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->age }}</td>
                    <td>
                        @if ($pet->type === 'Gato')
                            <i class="fs-2 fas fa-cat"></i>
                        @else
                            <i class="fs-2 fas fa-dog"></i>
                        @endif
                    </td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->sex }}</td>
                    <td><a href="{{ route('user.show', ['user' => $pet->user->id]) }}">{{ $pet->user->name }}</a></td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
@endsection --}}
