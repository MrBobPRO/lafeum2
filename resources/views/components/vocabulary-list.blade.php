@props(['terms'])

<div class="vocabulary-list">
    @foreach ($terms->chunk(ceil($terms->count() / 2)) as $chunk)
        <div class="vocabulary-list__dividers">
            @foreach ($chunk as $term)
                <div class="vocabulary-list__item">
                    <a class="vocabulary-list__link" data-body-loaded="0" data-id="{{ $term->id }}" href="{{ route('terms.show', $term->id) }}" target="_blank">{{ $term->name }}</a>
                    <div class="vocabulary-list__popup"></div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
