<aside class="leftbar categories-leftbar">
    <h2 class="leftbar__title main-title">{{ $title }}</h2>

    <div class="leftbar__body">
        <nav class="categories-nav">
            @foreach ($categories as $category)
                <div class="categories-nav__block">
                    <a class="categories-nav__link" href="{{ route($routeName, $category->slug) }}" target="_blank"><b>{{ $category->name }}</b></a>

                    @foreach ($category->children as $child)
                        <a class="categories-nav__link" href="{{ route($routeName, $child->slug) }}" target="_blank">{{ $child->name }}</a>
                    @endforeach
                </div>
            @endforeach
        </nav>
    </div>
</aside>
