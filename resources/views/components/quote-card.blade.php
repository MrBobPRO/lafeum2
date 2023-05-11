<div class="post-card quote-card">
    <div class="post-card__header">
        <div class="quote-card__title">
            <span class="material-symbols-outlined">person</span>
            <a class="quote-card__author" href="{{ route('authors.show', $quote->author->slug) }}" target="_blank">{{ $quote->author->name }}</a>
        </div>

        <a class="post-card__id" href="{{ route('quotes.show', $quote->id) }}" target="_blank">#{{ $quote->id }}</a>
    </div>

    <div class="post-card__body">
        @if ($quote->notes)
            <div class="quote-card__notes">{!! $quote->notes !!}</div>
        @endif

        <div class="post-card__txt">{!! $quote->body !!}</div>

        <div class="expand-more-container">
            <button class="expand-more">
                <span class="expand-more__expand-txt">Читать далее...</span>
                <span class="expand-more__hide-txt">Скрыть</span>
            </button>
        </div>

        <div class="post-card__categories">
            @foreach ($quote->categories as $cat)
                <a class="post-card__categories-link" href="{{ route('quotes.category', $cat->slug) }}" target="_blank">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="post-card__footer">
        <div class="post-card__actions">
            @auth
                <span class="material-symbols-outlined favorite {{ $quote->favoritedBy($currentUser) ? 'favorite--active' : '' }}" data-action="favorite" data-model="App\Models\Quote" data-id="{{ $quote->id }}">favorite</span>
            @else
                <span class="material-symbols-outlined favorite" data-action="redirect" data-url="{{ route('login') }}">favorite</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('quotes.show', $quote->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
