@extends('layouts.app', ['pageClass' => 'terms-category-page', 'includeRightBar' => true])

@section('leftbar')
    @include('layouts.categories-leftbar', ['title' => 'Термины по темам', 'routeName' => 'terms.category'])
@endsection

@section('main')
    <div class="terms-category-about">
        <div class="terms-category-about__inner">
            <h1 class="terms-category-about__title main-title">{{ $category->name }}</h1>
            <div class="terms-category-about__desc">{!! $category->description !!}</div>
        </div>
    </div>

    <x-terms-list :terms="$terms" />
@endsection
