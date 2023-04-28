<aside class="leftbar authors-leftbar">
    <h2 class="leftbar__title main-title">Поиск по имени</h2>

    <div class="leftbar__body leftbar__body--titled">
        <h3 class="leftbar__body-title"><span class="material-symbols-outlined">groups_2</span> Авторы</h3>
        <input class="leftbar__search" type="text" data-action="local-search" data-selector=".categories-nav__link" placeholder="Введите имя автора">

        <nav class="categories-nav categories-nav--limited thin-scrollbar">
            <div class="categories-nav__block">
                @foreach ($authors as $auth)
                    <a class="categories-nav__link" href="{{ route('authors.show', $auth->slug) }}" target="_blank">{{ $auth->name }}</a>
                @endforeach
            </div>
        </nav>
    </div>
</aside>

