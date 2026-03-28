<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script>
        (function () {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>

<body>
    @include('components.header')

    <section class="container">
        @yield('content')
    </section>

    @include('components.footer')

    <script>
        (function () {
            const toggle = document.getElementById('themeToggle');
            const iconSun = document.getElementById('iconSun');
            const iconMoon = document.getElementById('iconMoon');

            function updateIcons(theme) {
                if (theme === 'dark') {
                    iconSun.style.display = 'block';
                    iconMoon.style.display = 'none';
                } else {
                    iconSun.style.display = 'none';
                    iconMoon.style.display = 'block';
                }
            }

            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            updateIcons(currentTheme);

            toggle.addEventListener('click', () => {
                const current = document.documentElement.getAttribute('data-theme') || 'light';
                const next = current === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
                updateIcons(next);
            });
        })();
    </script>
</body>

</html>