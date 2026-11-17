{{-- Footer gelap: CTA besar, daftar isi bergaya brand guideline, wordmark raksasa. --}}
@php $nav = config('site.nav'); @endphp

<footer class="footer" data-station="{{ __('site.footer.contact') }}">
    <div class="footer__cta">
        <x-section-title :title="__('site.footer.title')" :muted="__('site.footer.muted')" size="xl" align="center" />
        <x-button :href="route('contact')" variant="light">{{ __('site.footer.button') }}</x-button>
    </div>

    <div class="footer__grid">
        <div class="footer__col footer__col--toc">
            <p class="eyebrow">{{ __('site.footer.toc') }}</p>
            <ul class="toc">
                @foreach ($nav as $item)
                    <li>
                        <a href="{{ route($item['route']) }}">
                            <x-line-badge :letter="$item['letter']" :color="$item['color']" size="sm" />
                            <span class="toc__label">{{ __("site.nav.{$item['key']}") }}</span>
                            <x-arrow dir="ne" />
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="footer__col">
            <p class="eyebrow">{{ __('site.footer.skills') }}</p>
            <ul class="footer__list">
                @foreach (__('site.services_short') as $service)
                    <li>{{ $service }}</li>
                @endforeach
            </ul>
        </div>

        <div class="footer__col">
            <p class="eyebrow">{{ __('site.footer.contact') }}</p>
            <ul class="footer__list">
                <li><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                @foreach (config('site.socials') as $social)
                    <li><a href="{{ $social['url'] }}" target="_blank" rel="noopener">{{ $social['name'] }} ↗</a></li>
                @endforeach
                <li>{{ __('site.location') }}</li>
            </ul>
        </div>
    </div>

    <div class="footer__bottom">
        <span>© {{ date('Y') }} {{ config('site.name') }}</span>
        <span>{{ __('site.footer.made_with', ['version' => app()->version()]) }}</span>
    </div>

    <p class="footer__wordmark" aria-hidden="true">{{ config('site.first_name') }}{{ config('site.last_name') }}</p>
</footer>
