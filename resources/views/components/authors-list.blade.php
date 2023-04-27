@props(['authors'])

<div class="authors-list">
    @foreach ($authors->chunk(ceil($authors->count() / 3)) as $chunk)
        <div class="authors-list__row">
            @foreach ($chunk as $author)
                <a class="authors-list__item" href="{{ route('authors.show', $author->slug) }}" target="_blank">{{ $author->name }}</a>
            @endforeach
        </div>
    @endforeach
</div>
