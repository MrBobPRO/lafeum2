@extends('layouts.app', ['pageClass' => 'favorite-videos-page', 'includeRightBar' => true])

@section('main')
    <div class="favorites-about">
        <div class="favorites-about__inner">
            <h1 class="favorites-about__title main-title">Избранные видео</h1>

            <x-videos-list :videos="$videos" />
        </div>
    </div>
@endsection
