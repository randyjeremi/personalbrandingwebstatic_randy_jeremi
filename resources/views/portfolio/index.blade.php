@extends('layouts.app')

@section('title', 'Portofolio')

@section('content')

    <section class="page-hero" data-station="Portofolio">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="3" color="red" size="sm" /> <span class="eyebrow">Portofolio · {{ $projects->count() }} proyek</span>
        </div>
        <x-section-title tag="h1" title="Karya &" muted="proyek pilihan." size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">Branding, web, motion, dan eksperimen AI. Klik kartu untuk melihat detail tiap proyek.</p>

        <div class="filters" data-filter-group role="group" aria-label="Filter kategori">
            <button type="button" class="chip is-active" data-filter="all">Semua</button>
            @foreach ($categories as $category)
                <button type="button" class="chip" data-filter="{{ $category }}">{{ $category }}</button>
            @endforeach
        </div>
    </section>

    <section class="section section--flush" data-station="Daftar">
        <div class="bento bento--even" data-filter-list>
            @foreach ($projects as $i => $project)
                <x-portfolio-card :project="$project" :index="$i" />
            @endforeach
        </div>
    </section>

@endsection
