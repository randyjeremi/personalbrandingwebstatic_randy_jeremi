<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') — {{ config('site.name') }} · {{ config('site.role') }}</title>
    <meta name="description" content="@yield('description', config('site.tagline'))">

    {{-- Menandai bahwa JavaScript aktif, agar animasi "muncul" hanya dipakai jika JS berjalan. --}}
    {{-- Pengaman: jika main.js gagal dimuat, tampilkan konten tanpa animasi setelah 3 detik. --}}
    <script>
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
            <span class="cta-pill__text">Punya proyek? Ayo ngobrol</span>
            <span class="cta-pill__btn">Hubungi <x-arrow /></span>
        </a>
    @endunless

    <div class="cursor" aria-hidden="true"><span class="cursor__label"></span></div>

    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>
</html>
