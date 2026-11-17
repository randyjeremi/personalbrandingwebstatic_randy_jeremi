@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <section class="page-hero" data-station="Blog">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="4" color="green" size="sm" /> <span class="eyebrow">Blog · {{ $posts->count() }} artikel</span>
        </div>
        <x-section-title tag="h1" title="Catatan," muted="tips & cerita." size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">Tulisan seputar desain, UI/UX, motion, AI, dan pengalaman di balik layar.</p>

        <div class="filters" data-filter-group role="group" aria-label="Filter kategori">
            <button type="button" class="chip is-active" data-filter="all">Semua</button>
            @foreach ($categories as $category)
                <button type="button" class="chip" data-filter="{{ $category }}">{{ $category }}</button>
            @endforeach
        </div>
    </section>

    <section class="section section--flush" data-station="Artikel">
        <div class="grid-3 grid-3--blog" data-filter-list>
            @forelse ($posts as $post)
                <x-blog-card :post="$post" :featured="$loop->first" />
            @empty
                <p>Belum ada artikel.</p>
            @endforelse
        </div>
    </section>

@endsection
