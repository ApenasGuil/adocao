@extends('layout.master-layout')
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
    
@endsection
