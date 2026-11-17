{{-- Judul dua tingkat: baris utama pekat + baris kedua abu-abu. --}}
@props([
    'title',
    'muted' => null,
    'tag' => 'h2',
    'size' => 'lg',
    'align' => 'left',
])

<{{ $tag }} {{ $attributes->merge(['class' => "stitle stitle--{$size} stitle--{$align}"]) }} data-reveal="lines">
    <span class="stitle__line"><span>{{ $title }}</span></span>
    @if ($muted)
        <span class="stitle__line stitle__muted"><span>{{ $muted }}</span></span>
    @endif
</{{ $tag }}>
