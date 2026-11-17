{{-- Tombol pil. variant: dark | light | outline | color --}}
@props([
    'href' => '#',
    'variant' => 'dark',
    'arrow' => 'ne',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => "btn btn--{$variant}"]) }}>
    <span class="btn__label" data-text="{{ trim(strip_tags($slot)) }}"><span>{{ $slot }}</span></span>
    @if ($arrow)
        <span class="btn__icon"><x-arrow :dir="$arrow" /></span>
    @endif
</a>
