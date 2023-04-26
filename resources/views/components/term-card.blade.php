<div class="post-card term-card">
    <div class="post-card__header">
        @if($term->termType->name == 'Термины научного мира')
            <div class="term-card__icons">
                <span class="material-symbols-outlined">brightness_5</span>
                <span class="material-symbols-outlined">brightness_5</span>
                <span class="material-symbols-outlined">brightness_5</span>
            </div>
        @else
            <div class="term-card__title">{{ $term->termType->name }}</div>
        @endif

        <a class="post-card__id" href="{{ route('terms.show', $term->id) }}" target="_blank">#{{ $term->id }}</a>
    </div>

    <div class="post-card__body">
        <div class="post-card__txt">{!! $term->body !!}</div>

        <div class="expand-more-container">
            <button class="expand-more">
                <span class="expand-more__expand-txt">Читать далее...</span>
                <span class="expand-more__hide-txt">Скрыть</span>
            </button>
        </div>

        <div class="post-card__categories">
            @foreach ($term->categories as $cat)
                <a class="post-card__categories-link" href="{{ route('terms.category', $cat->slug) }}">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="post-card__footer">
        <div class="post-card__actions">
            @auth
                <span class="favorite material-symbols-outlined" data-action="favorite-term" data-target="{{ $term->id }}">favorite</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('terms.show', $term->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
