@extends('layouts.app', ['pageClass' => 'knowledge-show-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.knowledge-leftbar')
@endsection

@section('main')
    <section class="knowledge-show-about">
        <div class="knowledge-show-about__inner">
            <h1 class="knowledge-show-about__title main-title">{{ $knowledge->name }}</h1>
            <div class="knowledge-show-about__desc">
                {!! $knowledge->description !!}
            </div>
        </div>
    </section>
@endsection
