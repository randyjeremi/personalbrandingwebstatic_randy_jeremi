{{--
    Ilustrasi poster bergaya Swiss (dipakai bila proyek/artikel belum punya foto).
    Jika "image" diisi, foto asli yang ditampilkan.
    variant: rings | bars | arrow | lines | dots
--}}
@props([
    'color' => 'yellow',
    'variant' => 'rings',
    'image' => null,
    'alt' => '',
    'letter' => null,
    'label' => null,
])

@php
    $patternId = 'hatch-'.\Illuminate\Support\Str::random(8);
    $isDark = in_array($color, ['ink', 'blue', 'red', 'green']);
    $hatch = "url(#{$patternId})";
@endphp

<div {{ $attributes->merge(['class' => 'poster poster--'.$variant.($isDark ? ' poster--dark' : ''), 'style' => "--c: var(--{$color})"]) }}>
    @if ($image)
        <img src="{{ asset($image) }}" alt="{{ $alt }}" loading="lazy">
    @else
        <svg class="poster__art" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid slice" role="img" aria-label="{{ $alt }}">
            <defs>
                <pattern id="{{ $patternId }}" width="9" height="9" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                    <rect width="3" height="9" class="p-ink" />
                </pattern>
            </defs>

            @switch($variant)
                @case('rings')
                    <circle cx="285" cy="160" r="128" fill="{{ $hatch }}" />
                    <circle cx="285" cy="160" r="84" class="p-ink" />
                    <circle cx="285" cy="160" r="36" class="p-bg" />
                    <rect x="36" y="236" width="150" height="10" class="p-ink" />
                    @break

                @case('bars')
                    @foreach ([120, 200, 92, 236, 150, 196] as $i => $h)
                        <rect x="{{ 34 + $i * 58 }}" y="{{ 300 - $h }}" width="44" height="{{ $h + 40 }}" rx="22"
                              @if ($i % 2) fill="{{ $hatch }}" @else class="p-ink" @endif />
                    @endforeach
                    @break

                @case('arrow')
                    <circle cx="112" cy="104" r="64" fill="{{ $hatch }}" />
                    <path d="M96 252 296 52M156 52h140v140" class="p-stroke" stroke-width="36" fill="none" />
                    @break

                @case('lines')
                    <path d="M-20 250 C 110 250 150 96 290 96 L 430 96" class="p-stroke" stroke-width="20" fill="none" />
                    <path d="M-20 214 C 92 214 132 62 272 62 L 430 62" stroke="{{ $hatch }}" stroke-width="20" fill="none" />
                    <path d="M-20 286 C 128 286 168 130 308 130 L 430 130" class="p-stroke" stroke-width="20" fill="none" opacity=".35" />
                    <circle cx="330" cy="96" r="22" class="p-bg p-ring" />
                    @break

                @default
                    @foreach (range(0, 3) as $row)
                        @foreach (range(0, 5) as $col)
                            @php $n = ($row * 6 + $col) % 5; @endphp
                            <circle cx="{{ 50 + $col * 60 }}" cy="{{ 60 + $row * 60 }}" r="22"
                                    @if ($n === 0) fill="{{ $hatch }}" @elseif ($n === 3) class="p-bg p-ring" @else class="p-ink" @endif />
                        @endforeach
                    @endforeach
            @endswitch
        </svg>

        @if ($letter)
            <x-line-badge :letter="$letter" color="ink" size="lg" class="poster__badge" />
        @endif
        @if ($label)
            <span class="poster__label">{{ $label }}</span>
        @endif
    @endif
</div>
