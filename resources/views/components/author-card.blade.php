<div class="author-card">
        @if ($author->photo)
            <img class="author-card__image" src="{{ asset('img/authors/' . $author->photo) }}" alt="{{ $author->name }}">
        @endif
        
        <div class="author-card__body">
            <h1 class="author-card__title">{{ $author->name }}</h1>
            <div class="author-card__biography">{!! $author->biography !!}</div>
        </div>
</div>
