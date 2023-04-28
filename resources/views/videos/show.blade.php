@extends('layouts.app', ['pageClass' => 'videos-show-page', 'includeRightBar' => true])

@section('main')
    <section class="videos-show">
        <div class="videos-show__inner">
            <div class="videos-list">
                <x-video-card :video="$video" />
            </div>
        </div>
    </section>
@endsection
