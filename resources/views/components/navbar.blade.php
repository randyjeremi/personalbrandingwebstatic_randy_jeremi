{{-- Header tetap (fixed) + menu layar penuh. Warna header otomatis terbalik di section gelap (mix-blend-mode). --}}
@php $nav = config('site.nav'); @endphp

<header class="header">
    <a href="{{ route('home') }}" class="logo" aria-label="{{ __('site.home_link', ['name' => config('site.name')]) }}">
        <span>{{ config('site.first_name') }}</span>
        <span>{{ config('site.last_name') }}</span>
    </a>

    <nav class="header__nav" aria-label="{{ __('site.main_nav') }}">
        @foreach ($nav as $item)
            <a href="{{ route($item['route']) }}" @class(['is-active' => request()->routeIs($item['match'])])
               @if (request()->routeIs($item['match'])) aria-current="page" @endif>{{ __("site.nav.{$item['key']}") }}</a>
        @endforeach
    </nav>

    <div class="header__end">
        <x-preferences class="header__prefs" />
        <a href="{{ route('contact') }}" class="header__cta">{{ __('site.header_cta') }}</a>
    </div>
</header>

<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu" data-menu-toggle>
    <span class="menu-toggle__label" data-open="{{ __('site.menu') }}" data-close="{{ __('site.close') }}">{{ __('site.menu') }}</span>
    <span class="menu-toggle__dots" aria-hidden="true"><i></i><i></i><i></i></span>
</button>

<div class="menu" id="site-menu" aria-hidden="true">
    <div class="menu__panel">
        <ul class="menu__list">
            @foreach ($nav as $i => $item)
                <li style="--i: {{ $i }}">
                    <a href="{{ route($item['route']) }}" @class(['is-active' => request()->routeIs($item['match'])]) tabindex="-1">
                        <x-line-badge :letter="$item['letter']" :color="$item['color']" size="md" />
                        <span>{{ __("site.nav.{$item['key']}") }}</span>
                        <x-arrow dir="ne" class="menu__arrow" />
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="menu__foot">
            <x-preferences class="menu__prefs" />
            <a href="mailto:{{ config('site.email') }}" tabindex="-1">{{ config('site.email') }}</a>
            <div class="menu__socials">
                @foreach (config('site.socials') as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener" tabindex="-1">{{ $social['name'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
