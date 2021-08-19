@extends('layouts.app')
@section('title', $pet->name)

@section('content')
@component('components.alert') @endcomponent
@component('components.workInProgress') @endcomponent
    <h1>Olá, eu sou {{ $pet->sex == "1" ? "o" : "a" }} {{ $pet->name }}</h1>
    <img style="width: 250px" src="{{ asset($pet->pegaimg()) }}" alt="">
    <h2>Tenho aproximadamente {{ $pet->age }} aninhos</h2>
    <h3>E sou {{ $pet->get_sex() }}</h3>
    <h4>Sou um {{ $pet->type }} e minha raça é {{ $pet->breed }}</h4>
    <h3>Meu atual dono(a) escreveu um pouquinho sobre mim: </h3>
    <div style="margin:20px;border:1px solid">
        <h2>{{ $pet->bio }}</h2>
    </div>
@endsection
