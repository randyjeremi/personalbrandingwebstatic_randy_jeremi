{{-- Kartu artikel blog. --}}
@props([
    'post',
    'featured' => false,
])

@php
    $url = route('blog.show', $post['slug']);
    $date = \Illuminate\Support\Carbon::parse($post['date']);
@endphp

<article {{ $attributes->merge(['class' => 'bcard'.($featured ? ' bcard--featured' : '')]) }} data-reveal="card" data-filter-item="{{ $post['category'] }}">
    <a href="{{ $url }}" class="bcard__media" data-cursor="Baca" tabindex="-1" aria-hidden="true">
        <x-poster :color="$post['color']" :variant="$post['variant']" :image="$post['image']" :alt="$post['title']" />
    </a>

    <div class="bcard__body">
        <div class="meta">
            <x-line-badge :letter="substr($post['category'], 0, 1)" :color="$post['color']" size="sm" />
            <span class="meta__cat">{{ $post['category'] }}</span>
            <span class="meta__dot" aria-hidden="true"></span>
            <time datetime="{{ $date->toDateString() }}">{{ $date->translatedFormat('d M Y') }}</time>
        </div>

        <h3 class="bcard__title"><a href="{{ $url }}">{{ $post['title'] }}</a></h3>
        <p class="bcard__excerpt">{{ $post['excerpt'] }}</p>

        <a href="{{ $url }}" class="link-arrow">Baca Selengkapnya <x-arrow /></a>
    </div>
</article>
