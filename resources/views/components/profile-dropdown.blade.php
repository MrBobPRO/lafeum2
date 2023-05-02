<div class="dropdown profile-dropdown">
    <button class="dropdown__button">
        <img class="profile-dropdown__image" src="{{ asset('img/users/' . auth()->user()->photo) }}" alt="ava">
        <span class="material-symbols-outlined profile-dropdown__caret">arrow_drop_down</span>
    </button>

    <div class="dropdown__content">
        <nav class="profile-nav">
            <p class="profile-nav__item">
                {{ auth()->user()->name }}
            </p>

            <a class="profile-nav__item" href="{{ route('favorites.quotes') }}">
                <span class="material-symbols-outlined">format_quote</span>
                Избранные цитаты
            </a>

            <a class="profile-nav__item" href="{{ route('favorites.terms') }}">
                <span class="material-symbols-outlined">description</span>
                Избранные термины
            </a>

            <a class="profile-nav__item" href="{{ route('favorites.videos') }}">
                <span class="material-symbols-outlined">smart_display</span>
                Избранные видео
            </a>

            <form class="profile-nav__item profile-logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <span class="material-symbols-outlined">logout</span>
                <button>Выйти из аккаунта</button>
            </form>
        </nav>
    </div>
</div>
