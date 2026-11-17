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
    <a href="{{ $url }}" class="bcard__media" data-cursor="{{ __('site.cursor.read') }}" tabindex="-1" aria-hidden="true">
        <x-poster :color="$post['color']" :variant="$post['variant']" :image="$post['image']" :alt="$post['title']" />
    </a>

    <div class="bcard__body">
        <div class="meta">
            <x-line-badge :letter="mb_substr($post['category_label'], 0, 1)" :color="$post['color']" size="sm" />
            <span class="meta__cat">{{ $post['category_label'] }}</span>
            <span class="meta__dot" aria-hidden="true"></span>
            <time datetime="{{ $date->toDateString() }}">{{ $date->translatedFormat(__('site.date_short')) }}</time>
        </div>

        <h3 class="bcard__title"><a href="{{ $url }}">{{ $post['title'] }}</a></h3>
        <p class="bcard__excerpt">{{ $post['excerpt'] }}</p>

        <a href="{{ $url }}" class="link-arrow">{{ __('site.read_more') }} <x-arrow /></a>
    </div>
</article>
