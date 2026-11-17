{{-- Lencana bulat ala simbol jalur subway. Contoh: <x-line-badge letter="3" color="red" /> --}}
@props([
    'letter' => '',
    'color' => 'ink',
    'size' => 'md',
    'arrow' => null,
])

@php
    // Warna terang memakai teks gelap, warna gelap memakai teks terang.
    // "ink" mengikuti warna teks tema (gelap di tema terang, terang di tema gelap).
    $tone = match (true) {
        $color === 'ink' => 'badge--ink',
        in_array($color, ['yellow', 'paper', 'bg']) => 'badge--on-light',
        default => 'badge--on-dark',
    };
    $fill = $color === 'ink' ? 'fg' : $color;
@endphp

<span {{ $attributes->merge(['class' => "badge badge--{$size} {$tone}", 'style' => "--c: var(--{$fill})"]) }} aria-hidden="true">
    @if ($arrow)
        <x-arrow :dir="$arrow" />
    @else
        {{ $letter }}
    @endif
</span>
