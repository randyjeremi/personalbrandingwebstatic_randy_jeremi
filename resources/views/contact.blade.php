@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

    <section class="page-hero page-hero--contact" data-station="Kontak">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="5" color="blue" size="sm" /> <span class="eyebrow">Kontak</span>
        </div>
        <x-section-title tag="h1" title="Ayo" muted="ngobrol." size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">
            Terbuka untuk proyek freelance, magang, maupun kolaborasi. Kirim email atau sapa saya lewat media sosial.
        </p>

        <div class="email-block" data-reveal="card">
            <span class="eyebrow">Email</span>
            <a href="mailto:{{ config('site.email') }}" class="email-block__link" data-cursor="Kirim">{{ config('site.email') }}</a>
            <button type="button" class="chip" data-copy="{{ config('site.email') }}">Salin email</button>
        </div>
    </section>

    <section class="section section--tight" data-station="Sosial">
        <p class="eyebrow">Media sosial</p>
        <ul class="toc toc--big">
            @foreach ($socials as $social)
                <li data-reveal="fade">
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener">
                        <x-line-badge :letter="$social['letter']" :color="$social['color']" size="md" />
                        <span class="toc__label">{{ $social['name'] }}</span>
                        <span class="toc__meta">{{ $social['handle'] }}</span>
                        <x-arrow dir="ne" />
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="details">
            @foreach ($details as $detail)
                <div class="details__item" data-reveal="fade">
                    <x-line-badge :letter="$detail['letter']" :color="$detail['color']" size="sm" />
                    <p class="eyebrow">{{ $detail['label'] }}</p>
                    <p>{{ $detail['value'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

@endsection
