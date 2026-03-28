@extends('master')

@section('content')

    <div class="main-title">
        <div>
            <h2>Editar Usuário</h2>
            <p class="page-subtitle">Edite os dados do usuário {{ $user->firstName }} {{ $user->lastName }}.</p>
        </div>

        <a href="{{ route('users.index') }}" class="icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
            </svg>
        </a>
    </div>

    <div class="content-card">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <p class="section-title">Dados do Usuário</p>
            <hr>
            <div class="user-data" style="margin-top: 1rem;">
                <div class="user-data-row">
                    <div class="input-title" style="width: 50%;">
                        <label for="firstName">Nome</label>
                        <input type="text" name="firstName" value="{{ $user->firstName }}">
                    </div>
                    <div class="input-title" style="width: 50%;">
                        <label for="lastName">Sobrenome</label>
                        <input type="text" name="lastName" value="{{ $user->lastName }}">
                    </div>
                </div>
                <div class="input-title">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" value="{{ $user->email }}">
                </div>
            </div>

            <div class="buttons">
                <a href="{{ route('users.index') }}">Voltar</a>
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>

    @if (session()->has('message'))
        @include('components.modal', [
            'modalType' => session('type', 'success'),
            'modalTitle' => session('type', 'success') === 'error' ? 'Erro' : 'Sucesso',
            'modalMessage' => session('message'),
            'modalRedirect' => route('users.index'),
        ])
    @endif

@endsection