@extends('layouts.app')

@section('title', __('contact.title'))

@section('content')

    <section class="page-hero page-hero--contact" data-station="{{ __('contact.title') }}">
        <div class="page-hero__label" data-reveal="fade">
            <x-line-badge letter="5" color="blue" size="sm" /> <span class="eyebrow">{{ __('contact.label') }}</span>
        </div>
        <x-section-title tag="h1" :title="__('contact.heading')" :muted="__('contact.muted')" size="hero" />
        <p class="lead page-hero__lead" data-reveal="fade">{{ __('contact.lead') }}</p>

        <div class="email-block" data-reveal="card">
            <span class="eyebrow">{{ __('contact.email') }}</span>
            <a href="mailto:{{ config('site.email') }}" class="email-block__link" data-cursor="{{ __('site.cursor.send') }}">{{ config('site.email') }}</a>
            <button type="button" class="chip" data-copy="{{ config('site.email') }}"
                    data-copy-done="{{ __('site.copy.done') }}" data-copy-fail="{{ __('site.copy.fail') }}">{{ __('site.copy.button') }}</button>
        </div>
    </section>

    <section class="section section--tight" data-station="{{ __('contact.socials') }}">
        <p class="eyebrow">{{ __('contact.socials') }}</p>
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
