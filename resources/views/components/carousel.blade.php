{{-- Galeri gambar yang bisa digeser (scroll-snap) + tombol, titik, dan penghitung. --}}
@props([
    'images' => [],
    'title' => '',
])

@php $total = count($images); @endphp

<div {{ $attributes->merge(['class' => 'carousel']) }} data-carousel>
    <div class="carousel__track" data-carousel-track data-cursor="Geser" tabindex="0" role="region" aria-label="Galeri {{ $title }}">
        @foreach ($images as $i => $image)
            <figure class="carousel__slide" data-carousel-slide>
                <img src="{{ asset($image) }}" alt="{{ $title }}, gambar {{ $i + 1 }} dari {{ $total }}"
                     @if ($i > 1) loading="lazy" @endif draggable="false">
            </figure>
        @endforeach
    </div>

    @if ($total > 1)
        <div class="carousel__ui">
            <p class="carousel__count" aria-live="polite">
                <span data-carousel-current>01</span> <span class="carousel__total">/ {{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</span>
            </p>

            <div class="carousel__dots">
                @foreach ($images as $i => $image)
                    <button type="button" @class(['carousel__dot', 'is-active' => $loop->first]) data-carousel-dot="{{ $i }}" aria-label="Gambar {{ $i + 1 }}"></button>
                @endforeach
            </div>

            <div class="carousel__nav">
                <button type="button" data-carousel-prev aria-label="Gambar sebelumnya"><x-arrow dir="left" /></button>
                <button type="button" data-carousel-next aria-label="Gambar berikutnya"><x-arrow /></button>
            </div>
        </div>
    @endif
</div>
