@extends('layouts.app', ['pageClass' => 'terms-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'Термины по темам', 'routeName' => 'terms.category'])
@endsection

@section('main')
    <div class="terms-about">
        <div class="terms-about__inner">
            <h1 class="terms-about__title main-title">Термины</h1>

            <x-terms-list :terms="$terms"/>
        </div>
    </div>
@endsection
