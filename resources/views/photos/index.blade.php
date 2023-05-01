@extends('layouts.app', ['pageClass' => 'photos-page', 'includeRightBar' => false])

@section('main')
    <div class="photos-about">
        <div class="photos-about__inner">
            <h1 class="photos-about__title main-title">Фотографии</h1>

            <x-photos-list :photos="$photos" />
        </div>
    </div>

@endsection
