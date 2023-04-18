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
                <h4 class="rightbar__quote-author"><a href="{{ route('authors.show', $todaysPost->quote->author->slug) }}">{{ $todaysPost->quote->author->name }}</a></h4>
                <img class="rightbar__quote-image" src="{{ asset('img/authors/' . $todaysPost->quote->author->photo) }}" alt="{{ $todaysPost->quote->author->name }}">
            </div>

            <p class="rightbar__quote-body">{{ $todaysPost->quote->body }}</p>

            <div class="rightbar__expand">
                <a href="{{ route('quotes.index') }}">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Term --}}
        <div class="rightbar__term rightbar__item">
            <h3 class="righbar__item-title">Термин дня</h3>

            <p class="rightbar__term-body">{!! $todaysPost->term->body !!}</p>

            <div class="rightbar__expand">
                <a href="{{ route('terms.index') }}">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Video --}}
        <div class="rightbar__video rightbar__item">
            <h3 class="righbar__item-title">Видео дня</h3>

            <div class="video-thumb">
                <img class="video-thumb__image" src="{{ $todaysPost->video->thumbnail }}" alt="{{ $todaysPost->video->title }}">
                <span class="video-thumb__duration">{{ $todaysPost->video->duration }} : 00</span>
            </div>

            <p class="rightbar__video-body">{!! $todaysPost->video->title !!}</p>

            <div class="rightbar__expand">
                <a href="{{ route('videos.index') }}">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>

        {{-- Photo --}}
        <div class="rightbar__photo rightbar__item">
            <h3 class="righbar__item-title">Фотография дня</h3>

            <p class="rightbar__photo-body">{!! $todaysPost->photo->description !!}</p>

            <div class="rightbar__expand">
                <a href="{{ route('photos.index') }}">
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
            </div>
        </div>
    </div>
</aside>
