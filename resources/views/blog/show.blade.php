@extends('layouts.app')

@section('title', $post['title'])
@section('description', $post['excerpt'])

@php $date = \Illuminate\Support\Carbon::parse($post['date']); @endphp

@section('content')

    <article class="article">
        <header class="page-hero page-hero--detail" data-station="Artikel">
            <a href="{{ route('blog.index') }}" class="back-link" data-reveal="fade"><x-arrow dir="left" /> Semua artikel</a>

            <div class="meta meta--lg" data-reveal="fade">
                <x-line-badge :letter="substr($post['category'], 0, 1)" :color="$post['color']" size="sm" />
                <span class="meta__cat">{{ $post['category'] }}</span>
                <span class="meta__dot" aria-hidden="true"></span>
                <time datetime="{{ $date->toDateString() }}">{{ $date->translatedFormat('d F Y') }}</time>
                <span class="meta__dot" aria-hidden="true"></span>
                <span>{{ $post['read_time'] }} menit baca</span>
            </div>

            <h1 class="article__title" data-reveal="lines"><span class="stitle__line"><span>{{ $post['title'] }}</span></span></h1>
        </header>

        <div class="detail-media detail-media--article" data-reveal="card">
            <x-poster :color="$post['color']" :variant="$post['variant']" :image="$post['image']" :alt="$post['title']" />
        </div>

        <div class="prose prose--article" data-station="Isi">
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

        <nav class="pager" aria-label="Artikel lain">
            @if ($newer)
                <a href="{{ route('blog.show', $newer['slug']) }}" class="pager__link">
                    <span class="eyebrow"><x-arrow dir="left" /> Lebih baru</span>
                    <span>{{ $newer['title'] }}</span>
                </a>
            @else
                <span></span>
            @endif

            @if ($older)
                <a href="{{ route('blog.show', $older['slug']) }}" class="pager__link pager__link--next">
                    <span class="eyebrow">Lebih lama <x-arrow /></span>
                    <span>{{ $older['title'] }}</span>
                </a>
            @endif
        </nav>
    </article>

    <section class="section" data-station="Baca juga">
        <x-section-title title="Baca" muted="juga" size="lg" />
        <div class="grid-2">
            @foreach ($related as $item)
                <x-blog-card :post="$item" />
            @endforeach
        </div>
    </section>

@endsection
