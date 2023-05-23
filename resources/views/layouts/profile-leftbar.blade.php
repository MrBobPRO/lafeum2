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
            <div class="profile-leftbar__item">
                <a class="profile-leftbar__link {{ $routeName == 'profile.edit' ?  'profile-leftbar__link--active' : ''}}" href="{{ route('profile.edit') }}">
                    <span class="material-symbols-outlined">account_circle</span>
                    Мой профиль
                </a>
            </div>

            <div class="profile-leftbar__item">
                <a class="profile-leftbar__link {{ $routeName == 'likes.index' ?  'profile-leftbar__link--active' : ''}}" href="{{ route('likes.index') }}">
                    <span class="material-symbols-outlined">favorite</span>
                    Лайки
                </a>
            </div>

            <div class="profile-leftbar__item profile-leftbar__favorites">
                <a class="profile-leftbar__link {{ str_contains($routeName, 'favorites.') ?  'profile-leftbar__link--active' : ''}}" href="{{ route('favorites.index') }}">
                    <span class="material-symbols-outlined">folder_open</span>
                    Избранное
                </a>

                <div class="profile-leftbar__sublinks-container">
                    @foreach ($user->rootFolders as $folder)
                        <a class="profile-leftbar__sublink" href="{{ route('favorites.folder', $folder->id) }}">
                            <span class="material-symbols-outlined">subdirectory_arrow_right</span>
                            {{ $folder->name }}
                        </a>

                        @if ($folder->childs->count())
                            <div class="profile-leftbar__sublinks-childs">
                                @foreach ($folder->childs as $child)
                                    <a class="profile-leftbar__sublink" href="{{ route('favorites.folder', $child->id) }}">
                                        <span class="material-symbols-outlined">subdirectory_arrow_right</span>
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="profile-leftbar__item profile-leftbar__logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button><span class="material-symbols-outlined">logout</span> Выход</button>
                </form>
            </div>
        </nav>
    </div>
</aside>
