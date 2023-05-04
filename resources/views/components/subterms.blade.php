@props(['subterms'])
    @foreach ($subterms as $subterm)
        <div class="term-card__subterm" id="subterm{{ $subterm->id }}">{!! $subterm->body !!}</div>
    @endforeach
