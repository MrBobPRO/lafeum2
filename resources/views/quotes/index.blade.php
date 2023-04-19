@extends('layouts.app', ['pageClass' => 'quotes-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.leftbar', ['title' => 'Цитаты по темам', 'routeName' => 'quotes.category'])
@endsection

@section('main')
    <section class="quotes-about">
        <div class="quotes-about__inner">
            <h1 class="quotes-about__title main-title">Цитаты и Афоризмы</h1>
            <p class="quotes-about__desc">
                Лучшие цитаты, афоризмы и высказывания великих ученых и мыслителей, и успешных людей на тематику сайта.
            </p>
        </div>
    </section>
@endsection
