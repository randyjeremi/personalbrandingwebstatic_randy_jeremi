@extends('layouts.app')

@section('title', $post['title'])
@section('description', $post['excerpt'])

@php $date = \Illuminate\Support\Carbon::parse($post['date']); @endphp

@section('content')

    <article class="article">
        <header class="page-hero page-hero--detail" data-station="{{ $post['category_label'] }}">
            <a href="{{ route('blog.index') }}" class="back-link" data-reveal="fade"><x-arrow dir="left" /> {{ __('blog.back') }}</a>

            <div class="meta meta--lg" data-reveal="fade">
                <x-line-badge :letter="mb_substr($post['category_label'], 0, 1)" :color="$post['color']" size="sm" />
                <span class="meta__cat">{{ $post['category_label'] }}</span>
                <span class="meta__dot" aria-hidden="true"></span>
                <time datetime="{{ $date->toDateString() }}">{{ $date->translatedFormat(__('site.date')) }}</time>
                <span class="meta__dot" aria-hidden="true"></span>
                <span>{{ __('blog.read_time', ['minutes' => $post['read_time']]) }}</span>
            </div>

            <h1 class="article__title" data-reveal="lines"><span class="stitle__line"><span>{{ $post['title'] }}</span></span></h1>
        </header>

        <div class="detail-media detail-media--article" data-reveal="card">
            <x-poster :color="$post['color']" :variant="$post['variant']" :image="$post['image']" :alt="$post['title']" />
        </div>

        <div class="prose prose--article" data-station="{{ __('site.read_more') }}">
            <p class="lead">{{ $post['excerpt'] }}</p>

            @foreach ($post['content'] as $block)
                @switch($block['type'])
                    @case('h2')
                        <h2>{{ $block['text'] }}</h2>
                        @break
                    @case('list')
                        <ul>
                            @foreach ($block['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        @break
                    @case('quote')
                        <blockquote @class(['is-dark' => in_array($post['color'], ['blue', 'red', 'green'])]) style="--c: var(--{{ $post['color'] }})">{{ $block['text'] }}</blockquote>
                        @break
                    @default
                        <p>{{ $block['text'] }}</p>
                @endswitch
            @endforeach
        </div>

        <nav class="pager" aria-label="{{ __('blog.other') }}">
            @if ($newer)
                <a href="{{ route('blog.show', $newer['slug']) }}" class="pager__link">
                    <span class="eyebrow"><x-arrow dir="left" /> {{ __('blog.newer') }}</span>
                    <span>{{ $newer['title'] }}</span>
                </a>
            @else
                <span></span>
            @endif

            @if ($older)
                <a href="{{ route('blog.show', $older['slug']) }}" class="pager__link pager__link--next">
                    <span class="eyebrow">{{ __('blog.older') }} <x-arrow /></span>
                    <span>{{ $older['title'] }}</span>
                </a>
            @endif
        </nav>
    </article>

    <section class="section" data-station="{{ __('blog.related_title') }}">
        <x-section-title :title="__('blog.related_title')" :muted="__('blog.related_muted')" size="lg" />
        <div class="grid-2">
            @foreach ($related as $item)
                <x-blog-card :post="$item" />
            @endforeach
        </div>
    </section>

@endsection
