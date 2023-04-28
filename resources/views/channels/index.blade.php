@extends('layouts.app', ['pageClass' => 'channels-page', 'includeRightBar' => true])

@section('main')
    <section class="channels-about">
        <div class="channels-about__inner">
            <h1 class="channels-about__title main-title">Каналы</h1>
            <p class="channels-about__desc">
                Каналы. Полный список всех авторов по алфавиту, а также есть возможность поиска.
            </p>

            <form class="search-form submit-disabled">
                <input class="search-form__input" type="text" data-action="local-search" data-selector=".channels-list__item" placeholder="Введите имя канала">
                <button class="search-form__button" type="button">Поиск</button>
            </form>
        </div>

        <x-channels-list :channels="$channels" />
    </section>
@endsection
