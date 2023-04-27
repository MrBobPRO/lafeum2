@extends('layouts.app', ['pageClass' => 'videos-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'Видео по темам', 'routeName' => 'videos.category'])
@endsection

@section('main')
    <div class="videos-about">
        <div class="videos-about__inner">
            <h1 class="videos-about__title main-title">Видео</h1>

            <x-videos-list :videos="$videos" />
        </div>
    </div>
@endsection
