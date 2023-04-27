<div class="videos-list">
    @foreach ($videos as $video)
        <x-video-card :video="$video" />
    @endforeach

    @if($videos->hasPages())
        {{ $videos->links('layouts.pagination') }}
    @endif
</div>
