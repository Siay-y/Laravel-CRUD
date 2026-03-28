@extends('master')

@section('content')

    <h2>Bem vindo ao CRUD Laravel</h2>

    <a href="{{ route('users.index') }}" class="cards">
        <i class="bi bi-people-fill"></i>
        <span>Listagem de Usuários</span>
    </a>

@endsection