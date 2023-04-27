@extends('layouts.app', ['pageClass' => 'authors-page', 'includeRightBar' => true])

@section('main')
    <section class="authors-about">
        <div class="authors-about__inner">
            <h1 class="authors-about__title main-title">Авторы</h1>
            <p class="authors-about__desc">
                Полный список всех авторов по алфавиту, а также есть возможность поиска.
            </p>

            <form class="search-form submit-disabled">
                <input class="search-form__input" type="text" data-action="local-search" data-selector=".authors-list__item" placeholder="Введите имя автора">
                <button class="search-form__button" type="button">Поиск</button>
            </form>
        </div>

        <x-authors-list :authors="$authors" />
    </section>
@endsection
