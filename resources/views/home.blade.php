@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="hero" data-station="Mulai">
        <div class="hero__top" data-reveal="fade">
            <span class="eyebrow">Portofolio {{ date('Y') }}</span>
            <span class="hero__badges">
                <x-line-badge letter="B" color="yellow" size="sm" class="pop" />
                <x-line-badge letter="U" color="orange" size="sm" class="pop" />
                <x-line-badge letter="M" color="red" size="sm" class="pop" />
                <x-line-badge letter="A" color="blue" size="sm" class="pop" />
            </span>
        </div>

        <h1 class="hero__title" data-reveal="lines">
            <span class="stitle__line"><span>{{ config('site.name') }}<x-line-badge letter="R" color="orange" size="title" class="pop hero__mark" /></span></span>
            <span class="stitle__line"><span>Graphic &amp; <em>UI/UX</em></span></span>
            <span class="stitle__line stitle__muted"><span>Designer.</span></span>
        </h1>

        <div class="hero__bottom">
            <div class="hero__intro" data-reveal="fade">
                <x-avatar size="lg" />
                <div>
                    <p class="hero__tagline">{{ config('site.tagline') }}</p>
                    <p class="hero__meta">
                        <x-line-badge color="green" size="xs" /> {{ config('site.status') }} · {{ config('site.location') }}
                    </p>
                </div>
            </div>

            <div class="hero__actions" data-reveal="fade">
                <x-button :href="route('portfolio.index')">Lihat Portofolio</x-button>
                <x-button :href="route('about')" variant="outline">Tentang Saya</x-button>
                <x-button :href="route('blog.index')" variant="outline">Baca Blog</x-button>
            </div>

            <a href="#rute" class="hero__down" aria-label="Gulir ke bawah"><x-arrow dir="down" /></a>
        </div>

        <x-marquee :items="$marquee" />
    </section>

    {{-- ============ TRANSISI GARIS → PANEL (scroll-scrubbed) ============ --}}
    <section class="route-intro" id="rute" data-route-intro data-station="Rute">
        <div class="route-intro__sticky">
            <svg class="route-intro__lines" viewBox="0 0 1200 400" preserveAspectRatio="none" aria-hidden="true">
                <path d="M-10 330 C 300 330 420 120 700 120 S 1100 120 1210 120" pathLength="1" style="--k: 0; stroke: var(--yellow)" />
                <path d="M-10 360 C 320 360 440 150 720 150 S 1100 150 1210 150" pathLength="1" style="--k: 1; stroke: var(--orange)" />
                <path d="M-10 390 C 340 390 460 180 740 180 S 1100 180 1210 180" pathLength="1" style="--k: 2; stroke: var(--red)" />
                <path d="M-10 420 C 360 420 480 210 760 210 S 1100 210 1210 210" pathLength="1" style="--k: 3; stroke: var(--blue)" />
            </svg>

            <div class="route-intro__panel">
                <div class="route-intro__content">
                    <p class="eyebrow">Rute saya</p>
                    <p class="route-intro__statement">
                        Dari <span class="hl" style="--c: var(--yellow)">Medan</span> ke <span class="hl" style="--c: var(--orange)">Surabaya</span>:
                        desain, web, dan motion untuk brand yang ingin <em>bergerak cepat</em>.
                    </p>
                    <div class="stats">
                        @foreach ($stats as $stat)
                            <x-stat :stat="$stat" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ KARYA UNGGULAN ============ --}}
    <section class="section" data-station="Karya">
        <div class="section__head section__head--center">
            <x-section-title title="Karya" muted="unggulan" size="xl" align="center" />
            <span class="down-arrow" data-reveal="fade"><x-arrow dir="down" /></span>
            <p class="lead" data-reveal="fade">Proyek pilihan yang menggabungkan strategi brand, visual yang tegas, dan detail yang rapi.</p>
        </div>

        <div class="bento">
            @foreach ($projects as $i => $project)
                <x-portfolio-card :project="$project" :index="$i" :wide="$loop->first" />
            @endforeach
        </div>

        <div class="section__more">
            <x-button :href="route('portfolio.index')">Semua karya</x-button>
        </div>
    </section>

    {{-- ============ KEAHLIAN: kartu bertumpuk (sticky stack) ============ --}}
    <section class="section section--services" data-station="Keahlian">
        <div class="section__head section__head--center">
            <x-section-title title="Yang saya kerjakan." muted="Cara saya bergerak cepat." size="lg" align="center" />
        </div>

        <div class="stack" data-stack>
            @foreach ($services as $i => $service)
                @php $dark = in_array($service['color'], ['blue', 'red']); @endphp
                <article class="stack__card {{ $dark ? 'is-dark' : '' }}" style="--c: var(--{{ $service['color'] }}); --i: {{ $i }}">
                    <div class="stack__text">
                        <div class="stack__top">
                            <h3>{{ $service['title'] }}</h3>
                            <span class="stack__num">({{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }})</span>
                        </div>
                        <p>{{ $service['desc'] }}</p>
                        <ul class="tags tags--inverse">
                            @foreach ($service['skills'] as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <x-poster :color="$service['color']" :variant="$service['variant']" class="stack__art" />
                </article>
            @endforeach
        </div>
    </section>

    {{-- ============ BLOG TERBARU ============ --}}
    <section class="section" data-station="Blog">
        <div class="section__head section__head--split">
            <x-section-title title="Tulisan" muted="terbaru" size="xl" />
            <x-button :href="route('blog.index')" variant="outline">Semua artikel</x-button>
        </div>

        <div class="grid-3">
            @foreach ($posts as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>
    </section>

    {{-- ============ TENTANG (teaser) ============ --}}
    <section class="big-type" data-station="Tentang">
        <p class="eyebrow" data-reveal="fade">Satu orang,</p>
        <p class="big-type__word" aria-label="ide besar">
            <span data-speed="-0.06">ide</span>
            <span data-speed="0.06">besar</span>
        </p>

        <div class="big-type__stickers" aria-hidden="true">
            <x-line-badge letter="B" color="yellow" size="xl" class="sticker" data-speed="0.18" style="--r: -12deg; --x: 8%; --y: 12%" />
            <x-line-badge letter="U" color="orange" size="xl" class="sticker" data-speed="-0.12" style="--r: 8deg; --x: 78%; --y: 6%" />
            <x-line-badge arrow="ne" color="ink" size="xl" class="sticker" data-speed="0.1" style="--r: 0deg; --x: 86%; --y: 62%" />
            <x-line-badge letter="M" color="red" size="xl" class="sticker" data-speed="-0.2" style="--r: 14deg; --x: 14%; --y: 70%" />
        </div>

        <div class="big-type__card" data-reveal="fade">
            <x-avatar size="md" />
            <p>Lulusan RPL SMK Telkom 1 Medan dan alumni Purwadhika UI/UX yang kini kuliah Informatika di Universitas Ciputra Surabaya.</p>
            <x-button :href="route('about')" variant="dark">Kenali saya</x-button>
        </div>
    </section>

@endsection
