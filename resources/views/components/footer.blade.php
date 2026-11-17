{{-- Footer gelap: CTA besar, daftar isi bergaya brand guideline, wordmark raksasa. --}}
@php $nav = config('site.nav'); @endphp

<footer class="footer" data-station="Kontak">
    <div class="footer__cta">
        <x-section-title title="Mari bikin setiap" muted="piksel berarti." size="xl" align="center" />
        <x-button :href="route('contact')" variant="light">Ayo ngobrol</x-button>
    </div>

    <div class="footer__grid">
        <div class="footer__col footer__col--toc">
            <p class="eyebrow">Daftar Isi</p>
            <ul class="toc">
                @foreach ($nav as $item)
                    <li>
                        <a href="{{ route($item['route']) }}">
                            <x-line-badge :letter="$item['letter']" :color="$item['color']" size="sm" />
                            <span class="toc__label">{{ $item['label'] }}</span>
                            <x-arrow dir="ne" />
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="footer__col">
            <p class="eyebrow">Keahlian</p>
            <ul class="footer__list">
                <li>Branding & Identitas Visual</li>
                <li>UI/UX & Web Design</li>
                <li>Motion Graphics</li>
                <li>AI-Assisted Creative</li>
            </ul>
        </div>

        <div class="footer__col">
            <p class="eyebrow">Kontak</p>
            <ul class="footer__list">
                <li><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                @foreach (config('site.socials') as $social)
                    <li><a href="{{ $social['url'] }}" target="_blank" rel="noopener">{{ $social['name'] }} ↗</a></li>
                @endforeach
                <li>{{ config('site.location') }}</li>
            </ul>
        </div>
    </div>

    <div class="footer__bottom">
        <span>© {{ date('Y') }} {{ config('site.name') }}</span>
        <span>Dibuat dengan Laravel {{ app()->version() }}</span>
    </div>

    <p class="footer__wordmark" aria-hidden="true">{{ config('site.first_name') }}{{ config('site.last_name') }}</p>
</footer>
