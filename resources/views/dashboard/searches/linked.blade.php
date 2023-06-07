<div class="search search--selectizeable">
    <select class="selectize-singular--linked" placeholder="Поиск...">
        <option></option>
        @foreach ($totalItems as $item)
            <option value="{{ route($modelTag . '.edit', $item->id) }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>
