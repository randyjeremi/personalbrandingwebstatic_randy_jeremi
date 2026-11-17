@extends('layouts.app')

@section('title', __('home.title'))

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="hero" data-station="{{ __('home.title') }}">
        <div class="hero__top" data-reveal="fade">
            <span class="eyebrow">{{ __('home.eyebrow', ['year' => date('Y')]) }}</span>
            <span class="hero__badges">
                <x-line-badge letter="B" color="yellow" size="sm" class="pop" />
                <x-line-badge letter="U" color="orange" size="sm" class="pop" />
                <x-line-badge letter="M" color="red" size="sm" class="pop" />
                <x-line-badge letter="A" color="blue" size="sm" class="pop" />
            </span>
        </div>

        <h1 class="hero__title" data-reveal="lines">
            <span class="stitle__line"><span>{{ config('site.name') }}<x-line-badge letter="R" color="orange" size="title" class="pop hero__mark" /></span></span>
            <span class="stitle__line"><span>{{ __('home.title_line_2') }} <em>UI/UX</em></span></span>
            <span class="stitle__line stitle__muted"><span>{{ __('home.title_line_3') }}</span></span>
        </h1>

        <div class="hero__bottom">
            <div class="hero__intro" data-reveal="fade">
                <x-avatar size="lg" />
                <div>
                    <p class="hero__tagline">{{ __('site.tagline') }}</p>
                    <p class="hero__meta">
                        <x-line-badge color="green" size="xs" /> {{ __('site.status') }} · {{ __('site.location') }}
                    </p>
                </div>
            </div>

            <div class="hero__actions" data-reveal="fade">
                <x-button :href="route('portfolio.index')">{{ __('home.btn_portfolio') }}</x-button>
                <x-button :href="route('about')" variant="outline">{{ __('home.btn_about') }}</x-button>
                <x-button :href="route('blog.index')" variant="outline">{{ __('home.btn_blog') }}</x-button>
            </div>

            <a href="#rute" class="hero__down" aria-label="{{ __('site.scroll_down') }}"><x-arrow dir="down" /></a>
        </div>

        <x-marquee :items="$marquee" />
    </section>

    {{-- ============ TRANSISI GARIS → PANEL (scroll-scrubbed) ============ --}}
    <section class="route-intro" id="rute" data-route-intro data-station="{{ __('home.route_eyebrow') }}">
        <div class="route-intro__sticky">
            <svg class="route-intro__lines" viewBox="0 0 1200 400" preserveAspectRatio="none" aria-hidden="true">
                <path d="M-10 330 C 300 330 420 120 700 120 S 1100 120 1210 120" pathLength="1" style="--k: 0; stroke: var(--yellow)" />
                <path d="M-10 360 C 320 360 440 150 720 150 S 1100 150 1210 150" pathLength="1" style="--k: 1; stroke: var(--orange)" />
                <path d="M-10 390 C 340 390 460 180 740 180 S 1100 180 1210 180" pathLength="1" style="--k: 2; stroke: var(--red)" />
                <path d="M-10 420 C 360 420 480 210 760 210 S 1100 210 1210 210" pathLength="1" style="--k: 3; stroke: var(--blue)" />
            </svg>

            <div class="route-intro__panel">
                <div class="route-intro__content">
                    <p class="eyebrow">{{ __('home.route_eyebrow') }}</p>
                    {{-- Teks terjemahan berisi penanda :from, :to, :em yang diganti dengan teks bergaris warna. --}}
                    <p class="route-intro__statement">
                        {!! __('home.statement', [
                            'from' => '<span class="hl" style="--c: var(--yellow)">Medan</span>',
                            'to' => '<span class="hl" style="--c: var(--orange)">Surabaya</span>',
                            'em' => '<em>'.e(__('home.statement_em')).'</em>',
                        ]) !!}
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
    <section class="section" data-station="{{ __('home.work_title') }}">
        <div class="section__head section__head--center">
            <x-section-title :title="__('home.work_title')" :muted="__('home.work_muted')" size="xl" align="center" />
            <span class="down-arrow" data-reveal="fade"><x-arrow dir="down" /></span>
            <p class="lead" data-reveal="fade">{{ __('home.work_lead') }}</p>
        </div>

        <div class="bento">
            @foreach ($projects as $i => $project)
                <x-portfolio-card :project="$project" :index="$i" :wide="$loop->first" />
            @endforeach
        </div>

        <div class="section__more">
            <x-button :href="route('portfolio.index')">{{ __('home.work_more') }}</x-button>
        </div>
    </section>

    {{-- ============ KEAHLIAN: kartu bertumpuk (sticky stack) ============ --}}
    <section class="section section--services" data-station="{{ __('site.footer.skills') }}">
        <div class="section__head section__head--center">
            <x-section-title :title="__('home.services_title')" :muted="__('home.services_muted')" size="lg" align="center" />
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
    <section class="section" data-station="{{ __('site.nav.blog') }}">
        <div class="section__head section__head--split">
            <x-section-title :title="__('home.blog_title')" :muted="__('home.blog_muted')" size="xl" />
            <x-button :href="route('blog.index')" variant="outline">{{ __('home.blog_more') }}</x-button>
        </div>

        <div class="grid-3">
            @foreach ($posts as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>
    </section>

    {{-- ============ TENTANG (teaser) ============ --}}
    <section class="big-type" data-station="{{ __('site.nav.about') }}">
        <p class="eyebrow" data-reveal="fade">{{ __('home.about_eyebrow') }}</p>
        <p class="big-type__word" aria-label="{{ __('home.about_word_1') }} {{ __('home.about_word_2') }}">
            <span data-speed="-0.06">{{ __('home.about_word_1') }}</span>
            <span data-speed="0.06">{{ __('home.about_word_2') }}</span>
        </p>

        <div class="big-type__stickers" aria-hidden="true">
            <x-line-badge letter="B" color="yellow" size="xl" class="sticker" data-speed="0.18" style="--r: -12deg; --x: 8%; --y: 12%" />
            <x-line-badge letter="U" color="orange" size="xl" class="sticker" data-speed="-0.12" style="--r: 8deg; --x: 78%; --y: 6%" />
            <x-line-badge arrow="ne" color="ink" size="xl" class="sticker" data-speed="0.1" style="--r: 0deg; --x: 86%; --y: 62%" />
            <x-line-badge letter="M" color="red" size="xl" class="sticker" data-speed="-0.2" style="--r: 14deg; --x: 14%; --y: 70%" />
        </div>

        <div class="big-type__card" data-reveal="fade">
            <x-avatar size="md" />
            <p>{{ __('home.about_text') }}</p>
            <x-button :href="route('about')" variant="dark">{{ __('home.about_button') }}</x-button>
        </div>
    </section>

@endsection
