@extends('layouts.app')

@section('title', $project['title'])
@section('description', $project['summary'])

@section('content')

    <article>
        <header class="page-hero page-hero--detail" data-station="Proyek">
            <a href="{{ route('portfolio.index') }}" class="back-link" data-reveal="fade"><x-arrow dir="left" /> Semua karya</a>

            <div class="detail-sign" data-reveal="fade">
                <span class="detail-sign__num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="detail-sign__cat">{{ $project['category'] }}</span>
            </div>

            <x-section-title tag="h1" :title="$project['title']" :muted="$project['client']" size="xl" />
        </header>

        @if (count($project['gallery']) > 0)
            <div class="detail-gallery" data-reveal="card">
                <x-carousel :images="$project['gallery']" :title="$project['title']" />
            </div>
        @else
            <div class="detail-media" data-reveal="card">
                <x-poster :color="$project['color']" :variant="$project['variant']"
                          :alt="'Visual proyek '.$project['title']" :letter="substr($project['category'], 0, 1)" :label="$project['year']" />
            </div>
        @endif

        <section class="section detail-body" data-station="Detail">
            <dl class="spec" data-reveal="fade">
                <div><dt>Klien</dt><dd>{{ $project['client'] }}</dd></div>
                <div><dt>Tahun</dt><dd>{{ $project['year'] }}</dd></div>
                <div><dt>Peran</dt><dd>{{ $project['role'] }}</dd></div>
                <div>
                    <dt>Teknologi & keahlian</dt>
                    <dd>
                        <ul class="tags">
                            @foreach ($project['tech'] as $tech)
                                <li>{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </dd>
                </div>
            </dl>

            <div class="prose">
                <p class="lead" data-reveal="fade">{{ $project['summary'] }}</p>
                @foreach ($project['description'] as $paragraph)
                    <p data-reveal="fade">{{ $paragraph }}</p>
                @endforeach
            </div>
        </section>
    </article>

    <a href="{{ route('portfolio.show', $next['slug']) }}" @class(['next-project', 'is-dark' => in_array($next['color'], ['blue', 'red', 'green'])]) style="--c: var(--{{ $next['color'] }})" data-cursor="Lanjut" data-station="Berikutnya">
        <span class="eyebrow">Proyek berikutnya</span>
        <span class="next-project__title">{{ $next['title'] }}</span>
        <span class="next-project__arrow"><x-arrow /></span>
    </a>

@endsection
