@extends('layout.master-layout')
@section('title', 'USERS')

@section('content')
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
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->pets->count() }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
