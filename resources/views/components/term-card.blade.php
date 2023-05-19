<div class="post-card term-card">
    <div class="post-card__header">
        @if($term->termType->name == 'Термины научного мира')
            <div class="term-card__icons">
                <img src="{{ asset('img/main/atom.svg') }}" alt="atom">
                <img src="{{ asset('img/main/atom.svg') }}" alt="atom">
                <img src="{{ asset('img/main/atom.svg') }}" alt="atom">
            </div>
        @else
            <div class="term-card__title">{{ $term->termType->name }}</div>
        @endif

        <a class="post-card__id" href="{{ route('terms.show', $term->id) }}" target="_blank">#{{ $term->id }}</a>
    </div>

    <div class="post-card__body">
        <div class="term-card__popup">
            <div class="term-card__popup-inner" data-subterm-id="0"></div>
        </div>

        <div class="post-card__txt">
            {!! $term->body !!}
            <div class="term-card__subterms-container">{!! $term->subterms !!}</div>
        </div>

        <div class="expand-more-container">
            <button class="expand-more">
                <span class="expand-more__expand-txt">Читать далее...</span>
                <span class="expand-more__hide-txt">Скрыть</span>
            </button>
        </div>

        <div class="post-card__categories">
            @foreach ($term->categories as $cat)
                <a class="post-card__categories-link" href="{{ route('terms.category', $cat->slug) }}" target="_blank">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="post-card__footer">
        <div class="post-card__actions">
            @auth
                <div class="dropdown favorite-dropdown">
                    <button class="dropdown__button">
                        <span class="material-symbols-outlined favorite-icon {{ $term->favoritedBy($currentUser) ? 'favorite-icon--active' : '' }}">bookmark</span>
                    </button>

                    <div class="dropdown__content">
                        <div class="favorite-form">
                            <p class="favorite-form__title">Выберите папку:</p>

                            @foreach ($userFolders as $folder)
                                <label class="label"><input type="checkbox" value="{{ $folder->id }}" @checked($term->favoritedBy($currentUser, $folder->id))>{{ $folder->name }}</label>
                            @endforeach

                            <button class="submit" data-action="favorite" data-model="App\Models\Term" data-id="{{ $term->id }}">Сохранить</button>
                        </div>
                    </div>
                </div>
            @else
                <span class="material-symbols-outlined favorite-icon" data-action="redirect" data-url="{{ route('login') }}">bookmark</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('terms.show', $term->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
