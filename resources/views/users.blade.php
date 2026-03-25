@extends('master')

@section('content')

    <h2>Users</h2>

    <ul>
        @foreach ($users as $user)
            <li>{{ $user->firstName }} | <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a> | <a
                    href="">Deletar</a></li>
        @endforeach
    </ul>

@endsection