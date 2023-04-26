<div class="quotes-list">
    @foreach ($quotes as $quote)
        <x-quote-card :quote="$quote" />
    @endforeach

    @if($quotes->hasPages())
        {{ $quotes->links('layouts.pagination') }}
    @endif
</div>
