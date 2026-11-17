@extends('layouts.app')

@section('title', 'Tentang Saya')

@section('content')

    {{-- ============ PROFIL ============ --}}
    <section class="page-hero" data-station="Profil">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="2" color="orange" size="sm" /> <span class="eyebrow">Tentang Saya</span>
        </div>
        <x-section-title tag="h1" title="Halo, saya" muted="Randy Jeremi." size="hero" />

        <div class="about-intro">
            <div class="about-intro__photo" data-reveal="fade">
                <x-avatar size="xl" />
                <ul class="facts">
                    <li><span>Lokasi</span>{{ config('site.location') }}</li>
                    <li><span>Status</span>{{ config('site.status') }}</li>
                    <li><span>Mode kerja</span>{{ config('site.work_modes') }}</li>
                </ul>
            </div>

            <div class="about-intro__text">
                @foreach ($profile as $paragraph)
                    <p @class(['lead' => $loop->first]) data-reveal="fade">{{ $paragraph }}</p>
                @endforeach
                <div class="about-intro__actions" data-reveal="fade">
                    <x-button :href="route('portfolio.index')">Lihat karya saya</x-button>
                    <x-button :href="route('contact')" variant="outline">Hubungi</x-button>
                </div>
            </div>
        </div>

        <div class="stats stats--light">
            @foreach ($stats as $stat)
                <x-stat :stat="$stat" />
            @endforeach
        </div>
    </section>

    {{-- ============ PENGALAMAN ============ --}}
    <section class="section section--dark" data-station="Pengalaman">
        <div class="two-col">
            <div class="two-col__head">
                <x-section-title title="Pengalaman" muted="kerja" size="lg" />
                <p class="muted-text" data-reveal="fade">Setiap stasiun adalah tempat saya belajar sesuatu yang baru.</p>
            </div>
            <ol class="timeline">
                @foreach ($experiences as $item)
                    <x-timeline-item :item="$item" />
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============ PENDIDIKAN ============ --}}
    <section class="section" data-station="Pendidikan">
        <div class="two-col">
            <div class="two-col__head">
                <x-section-title title="Pendidikan" muted="& latar belakang" size="lg" />
            </div>
            <ol class="timeline timeline--light">
                @foreach ($education as $item)
                    <x-timeline-item :item="$item" />
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============ SKILLS ============ --}}
    <section class="section section--tight" data-station="Skills">
        <x-section-title title="Keahlian" muted="(skills)" size="lg" />
        <div class="skills">
            @foreach ($skills as $group)
                <div class="skills__row" data-reveal="fade">
                    <div class="skills__group">
                        <x-line-badge :letter="$loop->iteration" :color="$group['color']" size="sm" />
                        <h3>{{ $group['group'] }}</h3>
                    </div>
                    <ul class="tags tags--lg">
                        @foreach ($group['items'] as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ PENGHARGAAN & SERTIFIKASI ============ --}}
    <section class="section" data-station="Pencapaian">
        <x-section-title title="Penghargaan" muted="& sertifikasi" size="lg" />

        <div class="awards">
            @foreach ($awards as $award)
                <article class="award" style="--c: var(--{{ $award['color'] }})" data-reveal="card">
                    <span class="award__rank">{{ $award['rank'] }}</span>
                    <div>
                        <h3>{{ $award['title'] }}</h3>
                        <p>{{ $award['issuer'] }}</p>
                    </div>
                    <time>{{ $award['date'] }}</time>
                </article>
            @endforeach
        </div>

        <ul class="certs">
            @foreach ($certificates as $cert)
                <li data-reveal="fade">
                    <x-line-badge :letter="substr($cert['issuer'], 0, 1)" color="ink" size="sm" />
                    <span class="certs__title">{{ $cert['title'] }}</span>
                    <span class="certs__issuer">{{ $cert['issuer'] }}</span>
                    <time>{{ $cert['date'] }}</time>
                </li>
            @endforeach
        </ul>
    </section>

@endsection
