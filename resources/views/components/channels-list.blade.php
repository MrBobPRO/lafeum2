@props(['channels'])

<div class="channels-list">
    @foreach ($channels->chunk(ceil($channels->count() / 3)) as $chunk)
        <div class="channels-list__row">
            @foreach ($chunk as $channel)
                <a class="channels-list__item" href="{{ route('channels.show', $channel->slug) }}" target="_blank">{{ $channel->name }}</a>
            @endforeach
        </div>
    @endforeach
</div>
