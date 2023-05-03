<aside class="rightbar">
    <h2 class="rightbar__title main-title">Материал дня</h2>

    <div class="rightbar__body">
        {{-- Quote --}}
        <div class="rightbar__quote rightbar__item">
            <h3 class="righbar__item-title">
                Цитата дня
                <span class="material-symbols-outlined">more_horiz</span>
            </h3>

            <div class="rightbar__quote-header">
                <h4 class="rightbar__quote-author"><a href="{{ route('authors.show', $todaysPost->quote->author->slug) }}" target="_blank">{{ $todaysPost->quote->author->name }}</a></h4>
                <img class="rightbar__quote-image" src="{{ asset('img/authors/' . $todaysPost->quote->author->photo) }}" alt="{{ $todaysPost->quote->author->name }}">
            </div>

            <div class="rightbar__quote-body">{!! $todaysPost->quote->body !!}</div>

            <div class="rightbar__expand">
                <a href="{{ route('quotes.index') }}" target="_blank">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Term --}}
        <div class="rightbar__term rightbar__item">
            <h3 class="righbar__item-title">Термин дня</h3>

            <div class="rightbar__term-body">{!! $todaysPost->term->body !!}</div>

            <div class="rightbar__expand">
                <a href="{{ route('terms.index') }}" target="_blank">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Video --}}
        <div class="rightbar__video rightbar__item">
            <h3 class="righbar__item-title">Видео дня</h3>

            <div class="video-thumb">
                <img class="video-thumb__image" src="{{ $todaysPost->video->thumbnail }}" data-video-src="{{ $todaysPost->video->embeded_link }}" data-video-title="{{ $todaysPost->video->title }}" alt="{{ $todaysPost->video->title }}">
                <span class="video-thumb__duration">{{ $todaysPost->video->duration }} : 00</span>
            </div>

            <p class="rightbar__video-body">{{ $todaysPost->video->title }}</p>

            <div class="rightbar__expand">
                <a href="{{ route('videos.index') }}" target="_blank">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Photo --}}
        <div class="rightbar__photo rightbar__item">
            <h3 class="righbar__item-title">Фотография дня</h3>

            <p class="rightbar__photo-body">{{ $todaysPost->photo->description }}</p>

            <div class="rightbar__expand">
                <a href="{{ route('photos.index') }}" target="_blank">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>
    </div>
</aside>
