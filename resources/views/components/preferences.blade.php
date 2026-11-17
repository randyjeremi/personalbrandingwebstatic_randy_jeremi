{{-- Pengaturan tampilan: pilihan bahasa (link ke route locale.switch) dan tema (diatur oleh main.js). --}}
<div {{ $attributes->merge(['class' => 'prefs']) }}>
    <nav class="prefs__group" aria-label="{{ __('site.language') }}">
        @foreach (config('site.locales') as $code => $label)
            <a href="{{ route('locale.switch', $code) }}" lang="{{ $code }}" hreflang="{{ $code }}"
               @class(['prefs__option', 'is-active' => app()->getLocale() === $code])
               @if (app()->getLocale() === $code) aria-current="true" @endif>{{ $label }}</a>
        @endforeach
    </nav>

    <div class="prefs__group" role="group" aria-label="{{ __('site.theme') }}">
        @foreach (config('site.themes') as $theme)
            <button type="button" class="prefs__option prefs__theme" data-theme-option="{{ $theme }}"
                    aria-pressed="false" title="{{ __("site.themes.{$theme}") }}">
                <x-theme-icon :theme="$theme" />
                <span class="sr-only">{{ __("site.themes.{$theme}") }}</span>
            </button>
        @endforeach
    </div>
</div>
