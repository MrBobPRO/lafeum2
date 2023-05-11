<aside class="leftbar profile-leftbar">
    <h2 class="leftbar__title main-title">{{ $title }}</h2>

    <div class="leftbar__body">
        <div class="user-box">
            <img class="user-box__image" src="{{ asset('img/users/' . $user->photo) }}" alt="{{ $user->name }}">

            <div class="user-box__txt">
                <h3 class="user-box__name">{{ $user->name }}</h3>
                <p class="user-box__role">{{ $user->role->name }}</p>
            </div>
        </div>

        <nav class="profile-leftbar__nav">
            <a class="profile-leftbar__nav-link {{ $routeName == 'profile.edit' ?  'profile-leftbar__nav-link--active' : ''}}" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined">account_circle</span>
                Мой профиль
            </a>

            <a class="profile-leftbar__nav-link" href="{{ route('favorites.quotes') }}">
                <span class="material-symbols-outlined">favorite</span>
                Избранное
            </a>

            <form class="profile-leftbar__nav-logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button><span class="material-symbols-outlined">logout</span> Выход</button>
            </form>
        </nav>
    </div>
</aside>
