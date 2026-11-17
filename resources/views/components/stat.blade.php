{{-- Angka besar yang menghitung naik saat terlihat. --}}
@props(['stat'])

<div {{ $attributes->merge(['class' => 'stat']) }} data-reveal="fade">
    <x-line-badge :letter="''" :color="$stat['color']" size="xs" />
    <p class="stat__num"><span data-count="{{ $stat['value'] }}">{{ $stat['value'] }}</span>{{ $stat['suffix'] }}</p>
    <p class="stat__label">{{ $stat['label'] }}</p>
</div>
