@extends('layouts.app', ['pageClass' => 'favorite-quotes-page', 'includeRightBar' => true])

@section('main')
    <div class="favorites-about">
        <div class="favorites-about__inner">
            <h1 class="favorites-about__title main-title">Избранные цитаты</h1>

            <x-quotes-list :quotes="$quotes" />
        </div>
    </div>
@endsection
