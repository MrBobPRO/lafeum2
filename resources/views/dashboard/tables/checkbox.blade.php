<div class="checkbox">
    <label for="item{{ $item->id }}">
        <input type="checkbox" name="id[]" id="item{{ $item->id }}" value="{{ $item->id }}" form="destroy-multiple-items-form">
        <span></span>
    </label>
</div>
