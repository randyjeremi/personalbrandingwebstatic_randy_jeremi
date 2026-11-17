<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('home.title')) — {{ config('site.name') }} · {{ __('site.role') }}</title>
    <meta name="description" content="@yield('description', __('site.tagline'))">

    {{--
        1. Pasang tema SEBELUM halaman tampil, supaya tidak berkedip.
           Urutan: pilihan tersimpan → pengaturan "kontras tinggi" sistem → mode gelap sistem → terang.
        2. Tandai bahwa JavaScript aktif, agar animasi "muncul" hanya dipakai jika JS berjalan.
        3. Pengaman: jika main.js gagal dimuat, tampilkan konten tanpa animasi setelah 3 detik.
    --}}
    <script>
        (function () {
            var themes = @json(config('site.themes'));
            var theme = null;
            try { theme = localStorage.getItem('theme'); } catch (e) {}
            if (themes.indexOf(theme) === -1) {
                theme = matchMedia('(prefers-contrast: more)').matches ? 'contrast'
                    : matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', theme);
        })();
        document.documentElement.classList.add('js');
        setTimeout(function () {
            if (!window.__rjReady) {
                document.documentElement.classList.remove('js');
                document.body.classList.add('is-loaded');
            }
        }, 3000);
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><circle cx='16' cy='16' r='16' fill='%23FF6319'/><text x='16' y='22' font-family='Arial' font-weight='700' font-size='16' text-anchor='middle' fill='white'>R</text></svg>">
</head>
<body class="@yield('body_class')">
    <div class="curtain" aria-hidden="true"></div>

    <x-navbar />
    <x-side-rail />

    <main id="main">
        @yield('content')
    </main>

    <x-footer />

    @unless (request()->routeIs('contact'))
        <a href="{{ route('contact') }}" class="cta-pill" data-cta-pill>
            <span class="cta-pill__text">{{ __('site.cta_pill') }}</span>
            <span class="cta-pill__btn">{{ __('site.cta_pill_button') }} <x-arrow /></span>
        </a>
    @endunless

    <div class="cursor" aria-hidden="true"><span class="cursor__label"></span></div>

    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>
</html>
