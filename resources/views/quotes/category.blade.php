@extends('layouts.app', ['pageClass' => 'quotes-category-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'Цитаты по темам', 'routeName' => 'quotes.category'])
@endsection

@section('main')
    <div class="quotes-category-about">
        <div class="quotes-category-about__inner">
            <h1 class="quotes-category-about__title main-title">{{ $category->name }}</h1>
            <div class="quotes-category-about__desc">{!! $category->description !!}</div>
        </div>
    </div>

    <x-quotes-list :quotes="$quotes" />
@endsection
