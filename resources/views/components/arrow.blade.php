{{-- Panah tebal ala rambu. dir: right, left, up, down, ne (kanan atas), se (kanan bawah) --}}
@props(['dir' => 'right'])

<svg {{ $attributes->merge(['class' => "arrow arrow--{$dir}"]) }} viewBox="0 0 24 24" fill="none" aria-hidden="true">
    <path d="M3 12h16M12 4.5 19.5 12 12 19.5" stroke="currentColor" stroke-width="3" stroke-linecap="square" />
</svg>
