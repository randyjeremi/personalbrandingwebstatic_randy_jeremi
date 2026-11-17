@extends('layouts.app')

@section('title', __('blog.title'))

@section('content')

    <section class="page-hero" data-station="{{ __('blog.title') }}">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="4" color="green" size="sm" />
            <span class="eyebrow">{{ __('blog.label', ['count' => $posts->count()]) }}</span>
        </div>
        <x-section-title tag="h1" :title="__('blog.heading')" :muted="__('blog.muted')" size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">{{ __('blog.lead') }}</p>

        <div class="filters" data-filter-group role="group" aria-label="{{ __('site.filter_label') }}">
            <button type="button" class="chip is-active" data-filter="all">{{ __('site.all') }}</button>
            @foreach ($categories as $key => $label)
                <button type="button" class="chip" data-filter="{{ $key }}">{{ $label }}</button>
            @endforeach
        </div>
    </section>

    <section class="section section--flush" data-station="{{ __('blog.back') }}">
        <div class="grid-3 grid-3--blog" data-filter-list>
            @forelse ($posts as $post)
                <x-blog-card :post="$post" :featured="$loop->first" />
            @empty
                <p>{{ __('blog.empty') }}</p>
            @endforelse
        </div>
    </section>

@endsection
