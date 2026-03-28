@extends('master')

@section('content')

    <div class="main-title">
        <div>
            <h2>Visualizar Usuário — {{ $user->firstName }} {{ $user->lastName }}</h2>
            <p class="page-subtitle">Visualize os dados do usuário {{ $user->firstName }} {{ $user->lastName }}.</p>
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
        <p class="section-title">Dados do Usuário</p>
        <hr>
        <div class="user-data" style="margin-top: 1rem;">
            <div class="user-data-row">
                <div class="input-title" style="width: 50%;">
                    <label for="firstName">Nome</label>
                    <input type="text" name="firstName" value="{{ $user->firstName }}" readonly>
                </div>
                <div class="input-title" style="width: 50%;">
                    <label for="lastName">Sobrenome</label>
                    <input type="text" name="lastName" value="{{ $user->lastName }}" readonly>
                </div>
            </div>
            <div class="input-title">
                <label for="email">E-mail</label>
                <input type="text" name="email" value="{{ $user->email }}" readonly>
            </div>
        </div>

        <div class="buttons">
            <a href="{{ route('users.index') }}">Voltar</a>
            <a class="edit" href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>
            <button class="delete" type="button" id="btnDelete">Deletar</button>
        </div>
    </div>

    {{-- Modal de Confirmação --}}
    <div class="modal-overlay" id="modalConfirm" style="display: none;">
        <div class="modal-card">
            <div class="modal-icon modal-icon--confirm">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                </svg>
            </div>
            <h3 class="modal-title">Confirmar Exclusão</h3>
            <p class="modal-message">Deseja realmente remover o usuário <strong>{{ $user->firstName }}
                    {{ $user->lastName }}</strong>?</p>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn--cancel" id="btnCancelDelete">Não, voltar</button>
                <button class="modal-btn modal-btn--danger" id="btnConfirmDelete">Sim, remover</button>
            </div>
        </div>
    </div>

    {{-- Modal de Resultado --}}
    <div class="modal-overlay" id="modalResult" style="display: none;">
        <div class="modal-card">
            <div class="modal-icon" id="resultIcon"></div>
            <h3 class="modal-title" id="resultTitle"></h3>
            <p class="modal-message" id="resultMessage"></p>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn--primary" id="btnResultOk">Ok</button>
            </div>
        </div>
    </div>

    <script>
        const deleteUrl = "{{ route('users.destroy', ['user' => $user->id]) }}";
        const listUrl = "{{ route('users.index') }}";
        const csrfToken = "{{ csrf_token() }}";

        const modalConfirm = document.getElementById('modalConfirm');
        const modalResult = document.getElementById('modalResult');

        // Abrir modal de confirmação
        document.getElementById('btnDelete').addEventListener('click', () => {
            modalConfirm.style.display = 'flex';
            modalConfirm.style.animation = 'overlayFadeIn 0.3s ease';
            modalConfirm.querySelector('.modal-card').style.animation = 'modalFadeIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1)';
        });

        // Fechar modal de confirmação
        document.getElementById('btnCancelDelete').addEventListener('click', () => {
            closeOverlay(modalConfirm);
        });

        // Confirmar exclusão via AJAX
        document.getElementById('btnConfirmDelete').addEventListener('click', async () => {
            closeOverlay(modalConfirm);

            try {
                const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (data.success) {
                    showResult('success', 'Sucesso', data.message, true);
                } else {
                    showResult('error', 'Erro', data.message, false);
                }
            } catch (err) {
                showResult('error', 'Erro', 'Ocorreu um erro inesperado ao remover o usuário.', false);
            }
        });

        // Botão Ok do resultado
        document.getElementById('btnResultOk').addEventListener('click', () => {
            if (modalResult.dataset.redirect === 'true') {
                window.location.href = listUrl;
            } else {
                closeOverlay(modalResult);
            }
        });

        function showResult(type, title, message, shouldRedirect) {
            const icon = document.getElementById('resultIcon');
            const titleEl = document.getElementById('resultTitle');
            const msgEl = document.getElementById('resultMessage');

            // Limpar e definir a classe do ícone
            icon.className = 'modal-icon modal-icon--' + type;

            // Definir ícone SVG
            if (type === 'success') {
                icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/></svg>';
            } else {
                icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>';
            }

            titleEl.textContent = title;
            msgEl.textContent = message;
            modalResult.dataset.redirect = shouldRedirect ? 'true' : 'false';

            setTimeout(() => {
                modalResult.style.display = 'flex';
                modalResult.style.animation = 'overlayFadeIn 0.3s ease';
                modalResult.querySelector('.modal-card').style.animation = 'modalFadeIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1)';
            }, 300);
        }

        function closeOverlay(overlay) {
            const card = overlay.querySelector('.modal-card');
            card.style.animation = 'modalFadeOut 0.25s ease forwards';
            overlay.style.animation = 'overlayFadeOut 0.25s ease forwards';
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 250);
        }
    </script>

@endsection