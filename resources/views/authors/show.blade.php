@extends('layouts.app', ['pageClass' => 'authors-show-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.authors-leftbar')
@endsection

@section('main')
    <div class="authors-show-about">
        <div class="authors-show-about__inner">
            <x-author-card :author="$author" />
        </div>
    </div>

    <x-quotes-list :quotes="$quotes" />
@endsection
