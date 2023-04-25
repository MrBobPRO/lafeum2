@extends('layouts.app', ['pageClass' => 'vocabulary-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'словарь по темам', 'routeName' => 'vocabulary.category'])
@endsection

@section('main')
    <div class="vocabulary-about">
        <div class="vocabulary-about__inner">
            <div class="vocabulary-about__desc">
                На сегодня содержит более одной тысячи основных терминов, соответствующих тематике сайта. Для удобства термины дополнительно разбиты на темы. Большинство терминов взяты из Википедии с указанием ссылки на источник. В большинстве понятий имеются другие взаимосвязанные термины и ссылки. По мере обновления на основном источнике здесь они будут равным образом обновляться.
            </div>

            <form class="search-form vocabulary-search submit-disabled">
                <input class="search-form__input" type="text" data-action="local-search" data-selector=".vocabulary-list__link" placeholder="Введите термин">
                <button class="search-form__button" type="button">Поиск</button>
            </form>
        </div>
    </div>

    <x-vocabulary-list :terms="$terms" />
@endsection
