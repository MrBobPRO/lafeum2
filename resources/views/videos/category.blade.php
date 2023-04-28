@extends('layouts.app', ['pageClass' => 'videos-category-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'Видео по темам', 'routeName' => 'videos.category'])
@endsection

@section('main')
    <div class="videos-category-about">
        <div class="videos-category-about__inner">
            <h1 class="videos-category-about__title main-title">{{ $category->name }}</h1>
            <div class="videos-category-about__desc">{!! $category->description !!}</div>
        </div>
    </div>

    <x-videos-list :videos="$videos" />
@endsection
