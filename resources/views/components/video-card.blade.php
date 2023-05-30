<div class="post-card video-card" data-video-src="{{ $video->embeded_link }}" data-video-title="{{ $video->title }}">
    <div class="video-card__about">
        <div class="video-thumb">
            <img class="video-thumb__image" src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
            <span class="video-thumb__duration">{{ $video->duration }} : 00</span>
        </div>

        <h3 class="video-card__title">{{ $video->title }}</h3>
    </div>

    <div class="video-card__channel">
        <img class="video-card__channel-icon" src="{{ asset('img/main/youtube.svg') }}">
        <a class="video-card__channel-name" href="{{ route('channels.show', $video->channel->slug) }}" target="_blank">{{ $video->channel->name }}</a>
    </div>

    <div class="video-card__categories-divider">
        <div class="post-card__categories video-card__categories">
            @foreach ($video->categories as $cat)
                <a class="post-card__categories-link" href="{{ route('videos.category', $cat->slug) }}" target="_blank">{{ $cat->name }}</a>
            @endforeach
        </div>

        <a class="post-card__id" href="{{ route('videos.show', $video->id) }}" target="_blank">#{{ $video->id }}</a>
    </div>

    <div class="post-card__footer">
        <div class="post-card__actions">
            @auth
                <div class="like-container">
                    <span class="material-symbols-outlined like-icon {{ $video->likedBy($currentUser) ? 'like-icon--active' : '' }}" data-action="like" data-model="App\Models\Video" data-id="{{ $video->id }}">favorite</span>

                    <p class="like-container__counter">{{ $video->likesCount() ?: '' }}</p>
                </div>

                <div class="dropdown favorite-dropdown">
                    <button class="dropdown__button">
                        <span class="material-symbols-outlined favorite-icon {{ $video->favoritedBy($currentUser) ? 'favorite-icon--active' : '' }}">bookmark</span>
                    </button>

                    <div class="dropdown__content">
                        <div class="favorite-form">
                            <p class="favorite-form__title">Выберите папку:</p>

                            @foreach ($userFolders as $folder)
                                @if ($folder->childs->count())
                                    <div class="favorite-form__item">
                                        <label class="label"><input type="checkbox" value="{{ $folder->id }}" @checked($video->favoritedBy($currentUser, $folder->id))>{{ $folder->name }}</label>

                                        <div class="favorite-form__item-childs">
                                            <p class="favorite-form__title">Подпапки:</p>
                                            @foreach ($folder->childs as $child)
                                                <label class="label"><input type="checkbox" value="{{ $child->id }}" @checked($video->favoritedBy($currentUser, $child->id))>{{ $child->name }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <label class="label"><input type="checkbox" value="{{ $folder->id }}" @checked($video->favoritedBy($currentUser, $folder->id))>{{ $folder->name }}</label>
                                @endif
                            @endforeach

                            <button class="submit" data-action="favorite" data-model="App\Models\Video" data-id="{{ $video->id }}">Сохранить</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="like-container">
                    <span class="material-symbols-outlined like-icon" data-action="redirect" data-url="{{ route('login') }}">favorite</span>

                    <p class="like-container__counter">{{ $video->likesCount() ?: '' }}</p>
                </div>

                <span class="material-symbols-outlined favorite-icon" data-action="redirect" data-url="{{ route('login') }}">bookmark</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('videos.show', $video->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
