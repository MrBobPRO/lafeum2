@extends('layouts.app', ['pageClass' => 'terms-show-page', 'includeRightBar' => true])

@section('main')
    <section class="term-show">
        <div class="term-show__inner">
            <x-term-card :term="$term" />
        </div>
    </section>
@endsection
