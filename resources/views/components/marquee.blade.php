{{-- Teks berjalan tanpa henti. Daftar ditulis dua kali agar loop mulus. --}}
@props(['items' => []])

@php $colors = ['yellow', 'orange', 'red', 'green', 'blue', 'pink']; @endphp

<div {{ $attributes->merge(['class' => 'marquee']) }} aria-label="{{ __('site.skills_label') }}">
    @foreach ([1, 2] as $copy)
        <ul class="marquee__track" @if ($copy === 2) aria-hidden="true" @endif>
            @foreach ($items as $i => $item)
                <li><x-line-badge :color="$colors[$i % count($colors)]" size="xs" /> {{ $item }}</li>
            @endforeach
        </ul>
    @endforeach
</div>
