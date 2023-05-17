@extends('layouts.profile-app', ['pageClass' => 'folders-page'])

@section('leftbar')
    @include('layouts.profile-leftbar', ['title' => 'Избранное'])
@endsection

@section('main')
<div class="folder">
    <div class="folder__inner">
        <h1 class="folder__title main-title">{{ $folder->name }}</h1>

        <div class="mixed-list">
            @foreach ($paginatedItems as $item)
                @if ($item instanceof App\Models\Quote)
                    <x-quote-card :quote="$item" />

                @elseif ($item instanceof App\Models\Term)
                    <x-term-card :term="$item" />

                @elseif ($item instanceof App\Models\Video)
                    <x-video-card :video="$item" />
                @endif
            @endforeach

            @if($paginatedItems->hasPages())
                {{ $paginatedItems->links('layouts.pagination') }}
            @endif

            @unless (count($paginatedItems))
                <p>Здесь пока пусто!</p>
            @endunless
        </div>
    </div>
</div>

@endsection
