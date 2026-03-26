@extends('master')

@section('content')

    <h2>Visualizar Usuário - {{ $user->firstName }} {{ $user->lastName }}</h2>

    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

        <input type="text" name="firstName" value="{{ $user->firstName }}" readonly>
        <input type="text" name="lastName" value="{{ $user->lastName }}" readonly>
        <input type="text" name="email" value="{{ $user->email }}" readonly>

        <button type="submit">Deletar</button>
    </form>

@endsection