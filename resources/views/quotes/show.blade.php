@extends('layouts.app', ['pageClass' => 'quotes-show-page', 'includeRightBar' => true])

@section('main')
    <section class="quote-show">
        <div class="quote-show__inner">
            <x-quote-card :quote="$quote" />
        </div>
    </section>
@endsection
