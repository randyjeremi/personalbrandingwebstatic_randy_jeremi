{{-- Satu "stasiun" di garis waktu pengalaman/pendidikan. --}}
@props(['item'])

<li class="station" data-reveal="fade">
    <span class="station__dot" style="--c: var(--{{ $item['color'] ?? 'ink' }})" aria-hidden="true"></span>
    <p class="station__time">{{ $item['period'] }}</p>

    <div class="station__body">
        <h3>{{ $item['title'] }}</h3>
        <p class="station__org">{{ $item['org'] }} <span>· {{ $item['type'] }}</span></p>

        @isset($item['desc'])
            <p class="station__desc">{{ $item['desc'] }}</p>
        @endisset

        @if (! empty($item['points']))
            <ul class="station__points">
                @foreach ($item['points'] as $point)
                    <li>{{ $point }}</li>
                @endforeach
            </ul>
        @endif

        @if (! empty($item['tags']))
            <ul class="tags">
                @foreach ($item['tags'] as $tag)
                    <li>{{ $tag }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</li>
