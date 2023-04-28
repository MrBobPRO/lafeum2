@extends('layouts.app', ['pageClass' => 'channels-show-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.channels-leftbar')
@endsection

@section('main')
    <div class="channels-show-about">
        <div class="channels-show-about__inner">
            <h1 class="channels-show-about__title">{{ $channel->name }}</h1>
            <div class="channels-show-about__desc">{!! $channel->description !!}</div>
        </div>
    </div>

    <x-videos-list :videos="$videos" />
@endsection
