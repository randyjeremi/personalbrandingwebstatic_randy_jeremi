{{-- Lencana bulat ala simbol jalur subway. Contoh: <x-line-badge letter="3" color="red" /> --}}
@props([
    'letter' => '',
    'color' => 'ink',
    'size' => 'md',
    'arrow' => null,
])

@php
    // Warna terang memakai teks gelap, warna gelap memakai teks terang.
    $lightBackgrounds = ['yellow', 'paper', 'bg'];
    $tone = in_array($color, $lightBackgrounds) ? 'badge--on-light' : 'badge--on-dark';
@endphp

<span {{ $attributes->merge(['class' => "badge badge--{$size} {$tone}", 'style' => "--c: var(--{$color})"]) }} aria-hidden="true">
    @if ($arrow)
        <x-arrow :dir="$arrow" />
    @else
        {{ $letter }}
    @endif
</span>
