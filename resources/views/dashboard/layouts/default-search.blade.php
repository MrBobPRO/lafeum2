<div class="search search--default">
    <div class="search__inner">
        <form class="search__form search__form--quotes" action="{{ $action }}" method="POST">
            @csrf
            <input class="search__input" type="text" value="{{ $params['keyword'] }}" placeholder="Поиск..." minlength="2" required>
        </form>
    </div>
</div>
