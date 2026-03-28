@extends('master')

@section('content')

    <div class="main-title" style="display: flex; align-items: center; justify-content: space-between;">
        <h2 style="margin-bottom: 0;">Criar Novo Usuário</h2>
        <a href="{{ route('users.index') }}">
            <svg style="padding: 0.3rem; background-color: #000; border-radius: 4px; color: #fff;"
                xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-short"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
            </svg>
        </a>
    </div>

    <form action="{{ route('users.store') }}" method="POST" style="margin-top: 2rem;">
        @csrf

        <h5><strong>Dados do Usuário</strong></h5>
        <hr>
        <div class="user-data">
            <div class="user-data-row">
                <div class="input-title" style="width: 50%;">
                    <label for="firstName">Primeiro Nome</label>
                    <input type="text" name="firstName" placeholder="Seu Primeiro Nome">
                </div>
                <div class="input-title" style="width: 50%;">
                    <label for="lastName">Sobrenome</label>
                    <input type="text" name="lastName" placeholder="Seu Sobrenome">
                </div>
            </div>
            <div class="input-title">
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Seu E-mail">
            </div>
            <div class="input-title">
                <label for="password">Senha</label>
                <input type="password" name="password" placeholder="Sua Senha">
            </div>
        </div>

        <div class="buttons">
            <a href="{{ route('users.index') }}">Voltar</a>
            <button type="submit">Cadastrar</button>

        </div>
    </form>

    @if (session()->has('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

@endsection