<aside class="leftbar home-leftbar">
    <h2 class="leftbar__title main-title">Темы</h2>

    <div class="leftbar__body">
        @foreach ($categories as $category)
        <div class="accordion">
            {{-- Root category --}}
            <div class="accordion__item">
                <button class="accordion__button"><strong>{{ $category->name }}</strong></button>

                <div class="accordion__collapse">
                    @foreach ($category->supportedTypeLinks as $link)
                        <a href="{{ $link['href'] }}" target="_blank">{{ $link['label'] }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Child categories --}}
            @foreach ($category->children as $child)
                <div class="accordion__item">
                    <button class="accordion__button">{{ $child->name }}</button>

                    <div class="accordion__collapse">
                        @foreach ($child->supportedTypeLinks as $link)
                            <a href="{{ $link['href'] }}" target="_blank">{{ $link['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    </div>
</aside>
