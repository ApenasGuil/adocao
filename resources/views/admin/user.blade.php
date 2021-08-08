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
                <th scope="col">Bio</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user->pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->bio }}</td>
                </tr>
            @empty
                <tr>
                    <td>No pets added.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </p>
@endsection
