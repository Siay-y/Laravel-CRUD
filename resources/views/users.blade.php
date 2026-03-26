@extends('master')

@section('content')

    <h2>Lista de Usuários</h2>

    <a href="{{ route('users.create') }}">Criar</a>

    <hr>

    <ul>
        @foreach ($users as $user)
            <li>{{ $user->firstName }} | <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a> | <a
                    href="">Deletar</a></li>
        @endforeach
    </ul>

@endsection