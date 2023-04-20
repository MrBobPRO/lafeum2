<aside class="leftbar knowledge-leftbar">
    <h2 class="leftbar__title main-title">Область знаний</h2>

    <div class="leftbar__body leftbar__body--titled">
        <h3 class="leftbar__body-title">Область знаний</h3>
        <input class="leftbar__search" type="text" data-action="local-search" data-selector=".categories-nav__link" placeholder="Введите область знаний">

        <nav class="categories-nav categories-nav--limited thin-scrollbar">
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

