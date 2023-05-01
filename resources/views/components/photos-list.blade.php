<div class="photos-list">
    @foreach ($photos as $photo)
        <x-photo-card :photo="$photo" />
    @endforeach

    @if($photos->hasPages())
        {{ $photos->links('layouts.pagination') }}
    @endif
</div>
