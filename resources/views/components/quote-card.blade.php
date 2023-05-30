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
                <div class="like-container">
                    <span class="material-symbols-outlined like-icon {{ $quote->likedBy($currentUser) ? 'like-icon--active' : '' }}" data-action="like" data-model="App\Models\Quote" data-id="{{ $quote->id }}">favorite</span>

                    <p class="like-container__counter">{{ $quote->likesCount() ?: '' }}</p>
                </div>

                <div class="dropdown favorite-dropdown">
                    <button class="dropdown__button">
                        <span class="material-symbols-outlined favorite-icon {{ $quote->favoritedBy($currentUser) ? 'favorite-icon--active' : '' }}">bookmark</span>
                    </button>

                    <div class="dropdown__content">
                        <div class="favorite-form">
                            <p class="favorite-form__title">Выберите папку:</p>

                            @foreach ($userFolders as $folder)
                                @if ($folder->childs->count())
                                    <div class="favorite-form__item">
                                        <label class="label"><input type="checkbox" value="{{ $folder->id }}" @checked($quote->favoritedBy($currentUser, $folder->id))>{{ $folder->name }}</label>

                                        <div class="favorite-form__item-childs">
                                            <p class="favorite-form__title">Подпапки:</p>
                                            @foreach ($folder->childs as $child)
                                                <label class="label"><input type="checkbox" value="{{ $child->id }}" @checked($quote->favoritedBy($currentUser, $child->id))>{{ $child->name }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <label class="label"><input type="checkbox" value="{{ $folder->id }}" @checked($quote->favoritedBy($currentUser, $folder->id))>{{ $folder->name }}</label>
                                @endif
                            @endforeach

                            <button class="submit" data-action="favorite" data-model="App\Models\Quote" data-id="{{ $quote->id }}">Сохранить</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="like-container">
                    <span class="material-symbols-outlined like-icon" data-action="redirect" data-url="{{ route('login') }}">favorite</span>

                    <p class="like-container__counter">{{ $quote->likesCount() ?: '' }}</p>
                </div>

                <span class="material-symbols-outlined favorite-icon" data-action="redirect" data-url="{{ route('login') }}">bookmark</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('quotes.show', $quote->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
