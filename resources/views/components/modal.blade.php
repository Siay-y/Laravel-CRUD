{{-- Modal Component --}}
{{-- Usage: @include('components.modal', ['modalType' => 'success|error|confirm', 'modalTitle' => '...', 'modalMessage' => '...', 'modalRedirect' => '...', 'modalFormAction' => '...']) --}}

@php
    $type = $modalType ?? 'success';
    $title = $modalTitle ?? 'Sucesso';
    $message = $modalMessage ?? '';
    $redirect = $modalRedirect ?? null;
    $formAction = $modalFormAction ?? null;
@endphp

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-card">
        {{-- Icon --}}
        <div class="modal-icon modal-icon--{{ $type }}">
            @if ($type === 'success')
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                </svg>
            @elseif ($type === 'error')
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            @elseif ($type === 'confirm')
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                </svg>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="modal-title">{{ $title }}</h3>

        {{-- Message --}}
        <p class="modal-message">{{ $message }}</p>

        {{-- Buttons --}}
        <div class="modal-buttons">
            @if ($type === 'confirm')
                <button class="modal-btn modal-btn--cancel" onclick="closeModal()">Cancelar</button>
                @if ($formAction)
                    <form id="modalConfirmForm" action="{{ $formAction }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="modal-btn modal-btn--danger">Confirmar</button>
                    </form>
                @endif
            @else
                <button class="modal-btn modal-btn--primary" onclick="modalOk()">Ok</button>
            @endif
        </div>
    </div>
</div>

<script>
    function closeModal() {
        const overlay = document.getElementById('modalOverlay');
        const card = overlay.querySelector('.modal-card');
        card.style.animation = 'modalFadeOut 0.25s ease forwards';
        overlay.style.animation = 'overlayFadeOut 0.25s ease forwards';
        setTimeout(() => overlay.remove(), 250);
    }

    function modalOk() {
        @if ($redirect)
            window.location.href = '{{ $redirect }}';
        @else
            closeModal();
        @endif
    }
</script>
