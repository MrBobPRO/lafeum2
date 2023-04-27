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
                <span class="favorite material-symbols-outlined" data-action="favorite" data-target="{{ $video->id }}">favorite</span>
            @endauth
        </div>

        <div class="post-card__share">
            <div class="ya-share2" data-url="{{ route('videos.show', $video->id) }}" data-curtain data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
        </div>
    </div>
</div>
