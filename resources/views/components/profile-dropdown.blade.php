<div class="dropdown profile-dropdown">
    <button class="dropdown__button">
        <img class="profile-dropdown__image" src="{{ asset('img/users/' . auth()->user()->photo) }}" alt="ava">
        <span class="material-symbols-outlined profile-dropdown__caret">arrow_drop_down</span>
    </button>

    <div class="dropdown__content">
        <nav class="profile-dropdown__nav">
            <a class="profile-dropdown__nav-item" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined">account_circle</span>
                Мой профиль
            </a>

            <a class="profile-dropdown__nav-item profile-dropdown__nav-likes" href="{{ route('likes.index') }}">
                <span class="material-symbols-outlined">favorite</span>
                Лайки
            </a>

            <a class="profile-dropdown__nav-item profile-dropdown__nav-favorites" href="{{ route('favorites.index') }}">
                <span class="material-symbols-outlined">folder_open</span>
                Избранное
            </a>

            <form class="profile-dropdown__nav-item profile-dropdown__nav-logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button><span class="material-symbols-outlined">logout</span> Выход</button>
            </form>
        </nav>
    </div>
</div>
