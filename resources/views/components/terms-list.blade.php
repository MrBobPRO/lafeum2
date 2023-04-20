<div class="terms-list">
    @foreach ($terms as $term)
        <x-term-card :term="$term" />
    @endforeach

    @if($terms->hasPages())
        {{ $terms->links('layouts.pagination') }}
    @endif
</div>
