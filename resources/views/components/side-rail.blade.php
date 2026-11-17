{{-- Kiri: navigasi lencana jalur. Kanan: progress scroll berbentuk rute kereta (titik stasiun dibuat oleh JS). --}}
<nav class="rail rail--left" aria-label="{{ __('site.quick_nav') }}">
    @foreach (config('site.nav') as $item)
        @php $label = __("site.nav.{$item['key']}"); @endphp
        <a href="{{ route($item['route']) }}" @class(['rail__item', 'is-active' => request()->routeIs($item['match'])]) aria-label="{{ $label }}">
            <x-line-badge :letter="$item['letter']" :color="$item['color']" size="sm" />
            <span class="rail__tip">{{ $label }}</span>
        </a>
    @endforeach
</nav>

<div class="rail rail--right" aria-hidden="true">
    <div class="route">
        <span class="route__fill"></span>
        <div class="route__stations" data-stations></div>
    </div>
</div>

<div class="hud" aria-hidden="true">
    <span>{{ __('site.location') }}</span>
    <span class="hud__clock" data-clock data-tz="{{ config('site.timezone') }}">--:--</span>
</div>
