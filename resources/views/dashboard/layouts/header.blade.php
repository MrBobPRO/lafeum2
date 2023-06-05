<header class="header">
    {{-- Toggler --}}
    <div class="header__toggler-container">
        <h2 class="header__site-name">{{ env('APP_NAME') }}</h2>
        <button class="aside-toggler"><span class="material-symbols-outlined">menu</span></button>
    </div>

    {{-- Body start --}}
    <div class=" header__body">
        {{-- Title --}}
        <ul class="header__breadcrumbs">
            @foreach ($breadcrumbs as $crumb)
                <li>{!! $crumb !!}</li>
            @endforeach
        </ul>

        {{-- Actions --}}
        <ul class="header__actions">
            @if (in_array('create', $actions))
                <li>
                    <a href="{{ route($modelTag . '.create') }}">
                        <span class="material-symbols-outlined">add</span> Добавить
                    </a>
                </li>
            @endif

            @if (in_array('multiselect', $actions))
                <li>
                    <button class="header__action-select-all">
                        <span class="material-symbols-outlined">done_all</span> Отметить все
                    </button>
                </li>

                <li>
                    <button data-action="show-modal" data-modal-target=".modal--multiple-destroy">
                        <span class="material-symbols-outlined">clear</span> Удалить отмеченные
                    </button>
                </li>
            @endif
        </ul>
    </div> {{-- Body end --}}
</header>
