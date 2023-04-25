@extends('layouts.app', ['pageClass' => 'knowledge-page', 'includeRightBar' => true])

@section('main')
    <section class="knowledge-about">
        <div class="knowledge-about__inner">
            <h1 class="knowledge-about__title main-title">Области знаний</h1>
            <p class="knowledge-about__desc">
                В этой рубрике термины и комментарии специалистов классифицированы более развернуто по группам и направлениям.
            </p>

            <form class="search-form submit-disabled">
                <input class="search-form__input" type="text" data-action="local-search" data-selector=".knowledge-block__link" placeholder="Введите область знаний">
                <button class="search-form__button" type="button">Поиск</button>
            </form>
        </div>

        <div class="knowledge-block">
            @foreach ($knowledge as $item)
                <div class="knowledge-block__item">
                    <h2 class="knowledge-block__title main-title">{{ $item->name }}</h2>

                    <nav class="knowledge-block__nav">
                        @foreach ($item->children as $child)
                            <a class="knowledge-block__link" href="{{ route('knowledge.show', $child->slug) }}" target="_blank">{{ $child->name }}</a>
                        @endforeach
                    </nav>
                </div>
            @endforeach
        </div>
    </section>
@endsection
