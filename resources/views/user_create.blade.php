@extends('master')

@section('content')

    <h2>Criar Novo Usuário</h2>

    @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <input type="text" name="firstName" placeholder="Seu Primeiro Nome" value="Example">
        <input type="text" name="lastName" placeholder="Seu Sobrenome" value="Example">
        <input type="password" name="password" placeholder="Sua Senha" value="123456">
        <input type="email" name="email" placeholder="Seu E-mail" value="example@example.com">

        <a href="{{ route('users.index') }}">Voltar</a>
        <button type="submit">Cadastrar</button>
    </form>

@endsection