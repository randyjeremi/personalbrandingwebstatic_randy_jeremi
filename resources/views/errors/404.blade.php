@extends('layouts.app')

@section('title', __('site.not_found.title'))

@section('content')
    <section class="page-hero page-hero--404" data-station="404">
        <div class="page-hero__label">
            <x-line-badge letter="!" color="red" size="sm" /> <span class="eyebrow">{{ __('site.not_found.label') }}</span>
        </div>
        <x-section-title tag="h1" :title="__('site.not_found.heading')" :muted="__('site.not_found.muted')" size="hero" />
        <p class="lead page-hero__lead">{{ __('site.not_found.lead') }}</p>
        <div class="hero__actions">
            <x-button :href="route('home')">{{ __('site.not_found.home') }}</x-button>
            <x-button :href="route('portfolio.index')" variant="outline">{{ __('site.not_found.portfolio') }}</x-button>
        </div>
    </section>
@endsection
