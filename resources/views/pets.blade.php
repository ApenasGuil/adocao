@extends('layouts.app')
@section('title', 'Lista de pets')
@section('content')
    <h1>User: Lista de pets</h1>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
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
