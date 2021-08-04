@extends('layouts.app')
@section('title', 'USER')

@section('content')
    <br>
    <img src="{{ asset('uploads/avatars/') }}/{{ $user->avatar }}" id="user_pic">
    <p><strong>Nome:</strong> {{ $user->name }}</p>
    <p><strong>E-mail:</strong> {{ $user->email }}</p>
    <p>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Pets</th>
            </tr>
        </thead>
        @if ($user->pets->count())
            <tbody>
                @foreach ($user->pets as $pet)
                    <tr>
                        <td>{{ $pet->name }}</td>
                    </tr>
                @endforeach
            </tbody>
    </table>
@else
    <tr>
        <td>No pets added.</td>
    </tr>
    @endif
    </p>
@endsection
