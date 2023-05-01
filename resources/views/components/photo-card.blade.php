<div class="photo-card" data-image-src="{{ asset('img/photos/' . $photo->path) }}" data-image-desc="{{ $photo->description }}">
    <img class="photo-card__image" src="{{ asset('img/photos/' . $photo->path) }}">
    <p class="photo-card__desc">{{ $photo->description }}</p>
</div>
