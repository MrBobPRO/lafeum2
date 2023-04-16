<header class="header">
    <div class="header__inner">
        <a class="header__logo logo" href="{{ route('home') }}">
            <img class="logo__image" src="{{ asset('img/main/logo-light-ru.png') }}" alt="Лафеюм лого">
        </a>

        <x-navbar class="header__navbar" />

        @guest
            <a class="header__login-btn" href="{{ route('login') }}">Вход</a>
        @endguest

        @auth
            <form action="/logout" method="POST">
                @csrf

                <button class="header__login-btn">Выйти</button>
            </form>
        @endauth
    </div>
</header>
