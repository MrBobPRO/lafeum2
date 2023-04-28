<aside class="leftbar channels-leftbar">
    <h2 class="leftbar__title main-title">Поиск по каналам</h2>

    <div class="leftbar__body leftbar__body--titled">
        <h3 class="leftbar__body-title"><span class="material-symbols-outlined">groups_2</span> Каналы</h3>
        <input class="leftbar__search" type="text" data-action="local-search" data-selector=".categories-nav__link" placeholder="Введите имя канала">

        <nav class="categories-nav categories-nav--limited thin-scrollbar">
            <div class="categories-nav__block">
                @foreach ($channels as $chan)
                    <a class="categories-nav__link" href="{{ route('channels.show', $chan->slug) }}" target="_blank">{{ $chan->name }}</a>
                @endforeach
            </div>
        </nav>
    </div>
</aside>

