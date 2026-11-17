@extends('layouts.app')

@section('title', __('portfolio.title'))

@section('content')

    <section class="page-hero" data-station="{{ __('portfolio.title') }}">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="3" color="red" size="sm" />
            <span class="eyebrow">{{ __('portfolio.label', ['count' => $projects->count()]) }}</span>
        </div>
        <x-section-title tag="h1" :title="__('portfolio.heading')" :muted="__('portfolio.muted')" size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">{{ __('portfolio.lead') }}</p>

        <div class="filters" data-filter-group role="group" aria-label="{{ __('site.filter_label') }}">
            <button type="button" class="chip is-active" data-filter="all">{{ __('site.all') }}</button>
            @foreach ($categories as $key => $label)
                <button type="button" class="chip" data-filter="{{ $key }}">{{ $label }}</button>
            @endforeach
        </div>
    </section>

    <section class="section section--flush" data-station="{{ __('portfolio.back') }}">
        <div class="bento bento--even" data-filter-list>
            @foreach ($projects as $i => $project)
                <x-portfolio-card :project="$project" :index="$i" />
            @endforeach
        </div>
    </section>

@endsection
