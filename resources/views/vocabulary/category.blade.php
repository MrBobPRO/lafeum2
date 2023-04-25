@extends('layouts.app', ['pageClass' => 'vocabulary-category-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'словарь по темам', 'routeName' => 'vocabulary.category'])
@endsection

@section('main')
    <div class="vocabulary-category-about">
        <div class="vocabulary-category-about__inner">
            <div class="vocabulary-category-about__desc">
                На сегодня содержит более одной тысячи основных терминов, соответствующих тематике сайта. Для удобства термины дополнительно разбиты на темы. Большинство терминов взяты из Википедии с указанием ссылки на источник. В большинстве понятий имеются другие взаимосвязанные термины и ссылки. По мере обновления на основном источнике здесь они будут равным образом обновляться.
            </div>

            <form class="search-form vocabulary-search submit-disabled">
                <input class="search-form__input" type="text" data-action="vocabulary-search" placeholder="Введите термин">
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <button class="search-form__button" type="button">Поиск</button>
            </form>
        </div>
    </div>

    <div class="vocabulary-list-container">
        <x-vocabulary-list :terms="$terms" />
    </div>
@endsection
