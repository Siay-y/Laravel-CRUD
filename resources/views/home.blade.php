@extends('master')

@section('content')

    <h2>Bem vindo ao CRUD Laravel</h2>

    <a href="{{ route('users.index') }}">Listagem de Usuários</a>

@endsection