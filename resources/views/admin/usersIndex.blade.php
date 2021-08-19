@extends('layouts.app')
@section('title', 'USERS')

@section('content')
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>Admin: Lista de usuários</h1>
            @component('components.alert') @endcomponent
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th>Pic</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Qt pets</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img width="30" src="{{ asset($user->get_user_avatar()) }}" alt=""></td>
                            <td><a href="{{ route('user.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->pets->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>












@endsection
