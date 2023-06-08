<div class="nested-set-container">
    <ol class="nested-set">
        @foreach ($items as $item)
            <li id="menuItem_{{ $item->id }}">
                <div class="nested-set__item">
                    <span class="nested-set__item-toggler material-symbols-outlined">expand_more</span>
                    <span class="nested-set__item-title">{{ $item->name }}</span>
                    <span class="nested-set__item-destroy-btn material-symbols-outlined">close</span>
                </div>

                @if (count($item->children))
                    <ol>
                        @foreach ($item->children as $child)
                            <li id="menuItem_{{ $child->id }}">
                                <div class="nested-set__item">
                                    <span class="nested-set__item-toggler material-symbols-outlined">expand_more</span>
                                    <span class="nested-set__item-title">{{ $child->name }}</span>
                                    <span class="nested-set__item-destroy-btn material-symbols-outlined">close</span>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </li>
        @endforeach
    </ol>
</div>
