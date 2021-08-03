@extends('layout.master-layout')
@section('title', 'USERS')

@section('content')
<h1>Admin: Lista de usuários</h1>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Qt pets</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('user.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->pets->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
