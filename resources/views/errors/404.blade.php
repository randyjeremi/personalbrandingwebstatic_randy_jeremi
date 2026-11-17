@extends('layouts.app')

@section('title', 'Halaman tidak ditemukan')

@section('content')
    <section class="page-hero page-hero--404" data-station="404">
        <div class="page-hero__label">
            <x-line-badge letter="!" color="red" size="sm" /> <span class="eyebrow">Error 404</span>
        </div>
        <x-section-title tag="h1" title="Stasiun ini" muted="tidak ada." size="hero" />
        <p class="lead page-hero__lead">Halaman yang kamu cari sudah pindah atau memang tidak pernah ada. Kembali ke rute utama, yuk.</p>
        <div class="hero__actions">
            <x-button :href="route('home')">Ke Beranda</x-button>
            <x-button :href="route('portfolio.index')" variant="outline">Lihat Portofolio</x-button>
        </div>
    </section>
@endsection
