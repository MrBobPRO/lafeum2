<div class="photo-card" data-image-src="{{ asset('img/photos/' . $photo->path) }}">
    <img class="photo-card__image" src="{{ asset('img/photos/thumbs/' . $photo->path) }}">
    <p class="photo-card__desc">{{ $photo->description }}</p>
</div>
