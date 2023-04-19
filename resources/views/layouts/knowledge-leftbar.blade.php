<aside class="leftbar">
    <h2 class="leftbar__title main-title">Область знаний</h2>

    <div class="leftbar__body">
        <nav class="categories-nav">
            @foreach ($allKnowledge as $parent)
                <div class="categories-nav__block">
                    <b class="categories-nav__link">{{ $parent->name }}</b>

                    @foreach ($parent->children as $child)
                        <a class="categories-nav__link" href="{{ route('knowledge.show', $child->slug) }}" target="_blank">{{ $child->name }}</a>
                    @endforeach
                </div>
            @endforeach
        </nav>
    </div>
</aside>

