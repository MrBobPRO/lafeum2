@extends('layouts.app', ['pageClass' => 'favorite-terms-page', 'includeRightBar' => true])

@section('main')
    <div class="favorites-about">
        <div class="favorites-about__inner">
            <h1 class="favorites-about__title main-title">Избранные термины</h1>

            <x-terms-list :terms="$terms" />
        </div>
    </div>
@endsection
