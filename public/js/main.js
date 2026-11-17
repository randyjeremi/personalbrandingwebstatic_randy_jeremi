/* ==========================================================================
   Interaksi & motion
   1. Scroll halus (Lenis)          6. Kartu bertumpuk (sticky stack)
   2. Tirai transisi halaman         7. Progress rute + stasiun
   3. Menu                           8. Parallax, angka, pil CTA, jam
   4. Animasi muncul (reveal)        9. Kursor custom
   5. Transisi garis → panel        10. Filter kategori & salin email
   ========================================================================== */
(() => {
    window.__rjReady = true;

    const html = document.documentElement;
    const body = document.body;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

    /* ---------- 1. Scroll halus ---------- */
    let lenis = null;
    if (window.Lenis && !reduceMotion) {
        lenis = new window.Lenis({ duration: 1.15, smoothWheel: true });
        const raf = (time) => { lenis.raf(time); requestAnimationFrame(raf); };
        requestAnimationFrame(raf);
    }

    const scrollToTarget = (target) => {
        if (lenis) lenis.scrollTo(target, { offset: 0 });
        else target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth' });
    };

    $$('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const target = $(link.getAttribute('href'));
            if (!target) return;
            event.preventDefault();
            scrollToTarget(target);
        });
    });

    /* ---------- 2. Tirai transisi halaman ---------- */
    setTimeout(() => body.classList.add('is-loaded'), 60);

    // Saat kembali lewat tombol Back (bfcache), pastikan tirai terbuka lagi.
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) body.classList.remove('is-leaving');
    });

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a');
        if (!link || reduceMotion) return;
        const url = new URL(link.href, location.href);
        const isInternal = url.origin === location.origin;
        const isSamePage = url.pathname === location.pathname && url.hash;
        if (!isInternal || isSamePage || link.target === '_blank' || link.hasAttribute('download')
            || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.defaultPrevented) return;

        event.preventDefault();
        body.classList.add('is-leaving');
        setTimeout(() => { location.href = url.href; }, 450);
    });

    /* ---------- 3. Menu ---------- */
    const toggle = $('[data-menu-toggle]');
    const menu = $('#site-menu');
    const label = toggle ? $('.menu-toggle__label', toggle) : null;

    const setMenu = (open) => {
        body.classList.toggle('menu-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        menu.setAttribute('aria-hidden', String(!open));
        label.textContent = open ? label.dataset.close : label.dataset.open;
        $$('a', menu).forEach((a) => { a.tabIndex = open ? 0 : -1; });
        if (lenis) open ? lenis.stop() : lenis.start();
        if (open) setTimeout(() => $('a', menu)?.focus({ preventScroll: true }), 300);
    };

    if (toggle && menu) {
        toggle.addEventListener('click', () => setMenu(!body.classList.contains('menu-open')));
        menu.addEventListener('click', (event) => { if (event.target === menu) setMenu(false); });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && body.classList.contains('menu-open')) { setMenu(false); toggle.focus(); }
        });
    }

    /* ---------- 4. Animasi muncul ---------- */
    const counters = new WeakSet();
    const countUp = (el) => {
        if (counters.has(el)) return;
        counters.add(el);
        const end = Number(el.dataset.count);
        const start = end > 1000 ? end - 30 : 0;   // tahun (mis. 2021) menghitung dari dekat, bukan dari 0
        const duration = 1400;
        const t0 = performance.now();
        const tick = (now) => {
            const t = Math.min((now - t0) / duration, 1);
            const eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(start + (end - start) * eased);
            if (t < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            $$('[data-count]', entry.target).forEach(countUp);
            revealObserver.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });

    // Elemen dalam grid yang sama muncul bergantian (stagger).
    $$('[data-reveal]').forEach((el) => {
        const siblings = el.parentElement ? [...el.parentElement.children].filter((c) => c.hasAttribute('data-reveal')) : [];
        const order = Math.max(siblings.indexOf(el), 0);
        if (el.dataset.reveal !== 'lines') el.style.transitionDelay = `${Math.min(order, 5) * 70}ms`;
        revealObserver.observe(el);
    });

    if (reduceMotion) $$('[data-count]').forEach((el) => { el.textContent = el.dataset.count; });

    /* ---------- 5–8. Semua efek yang mengikuti posisi scroll ---------- */
    const routeIntro = $('[data-route-intro]');
    const stackCards = $$('[data-stack] .stack__card');
    const parallaxEls = $$('[data-speed]');
    const ctaPill = $('[data-cta-pill]');
    const footer = $('.footer');
    const stationWrap = $('[data-stations]');
    const sections = $$('[data-station]');
    const clamp = (v, min = 0, max = 1) => Math.min(Math.max(v, min), max);

    // Buat titik stasiun di progress bar kanan sesuai section yang ada di halaman.
    let stationDots = [];
    const buildStations = () => {
        if (!stationWrap) return;
        stationWrap.innerHTML = '';
        const total = document.documentElement.scrollHeight - innerHeight;
        stationDots = sections.map((section) => {
            const dot = document.createElement('span');
            dot.className = 'route__station';
            const top = section.getBoundingClientRect().top + scrollY;
            dot.dataset.at = clamp(top / Math.max(total, 1));
            dot.style.top = `${dot.dataset.at * 100}%`;
            stationWrap.appendChild(dot);
            return dot;
        });
    };

    let ticking = false;
    const update = () => {
        ticking = false;
        const vh = innerHeight;
        const total = document.documentElement.scrollHeight - vh;
        const progress = clamp(scrollY / Math.max(total, 1));
        html.style.setProperty('--progress', progress.toFixed(4));

        // Stasiun: lewat / sedang aktif
        stationDots.forEach((dot, i) => {
            const at = Number(dot.dataset.at);
            const next = stationDots[i + 1] ? Number(stationDots[i + 1].dataset.at) : 1.01;
            dot.classList.toggle('is-passed', progress >= at - 0.001);
            dot.classList.toggle('is-current', progress >= at - 0.001 && progress < next);
        });

        // 5. Transisi garis → kotak → layar penuh
        if (routeIntro) {
            const rect = routeIntro.getBoundingClientRect();
            // 0 saat section mulai masuk dari bawah layar, 1 saat bagian sticky selesai.
            const p = clamp((vh - rect.top) / Math.max(rect.height, 1));
            routeIntro.style.setProperty('--p', p.toFixed(4));
            if (p > 0.75) $$('[data-count]', routeIntro).forEach(countUp);
        }

        // 6. Kartu yang tertimpa kartu berikutnya mengecil & meredup
        stackCards.forEach((card, i) => {
            const next = stackCards[i + 1];
            if (!next || reduceMotion) return;
            const cardTop = card.getBoundingClientRect().top;
            const nextTop = next.getBoundingClientRect().top;
            const covered = clamp(1 - (nextTop - cardTop) / Math.max(card.offsetHeight, 1));
            card.style.setProperty('--scale', (1 - covered * 0.06).toFixed(4));
            card.style.setProperty('--dim', (1 - covered * 0.25).toFixed(4));
        });

        // 8a. Parallax ringan
        if (!reduceMotion) {
            parallaxEls.forEach((el) => {
                const rect = el.parentElement.getBoundingClientRect();
                const offset = (rect.top + rect.height / 2 - vh / 2) * Number(el.dataset.speed);
                el.style.translate = `0 ${offset.toFixed(1)}px`;
            });
        }

        // 8b. Pil CTA muncul setelah hero, sembunyi di footer
        if (ctaPill) {
            const nearFooter = footer && footer.getBoundingClientRect().top < vh * 0.9;
            ctaPill.classList.toggle('is-visible', scrollY > vh * 0.6 && !nearFooter);
        }
    };

    const requestUpdate = () => {
        if (!ticking) { ticking = true; requestAnimationFrame(update); }
    };

    if (lenis) lenis.on('scroll', requestUpdate);
    window.addEventListener('scroll', requestUpdate, { passive: true });
    window.addEventListener('resize', () => { buildStations(); requestUpdate(); });
    window.addEventListener('load', () => { buildStations(); requestUpdate(); });
    buildStations();
    update();

    /* ---------- 8c. Jam lokal ---------- */
    const clock = $('[data-clock]');
    if (clock) {
        const format = new Intl.DateTimeFormat('id-ID', { hour: '2-digit', minute: '2-digit', timeZone: clock.dataset.tz, hour12: false });
        const renderClock = () => { clock.textContent = `${format.format(new Date())} WIB`; };
        renderClock();
        setInterval(renderClock, 15000);
    }

    /* ---------- 9. Kursor custom (hanya perangkat dengan mouse) ---------- */
    const cursor = $('.cursor');
    if (cursor && window.matchMedia('(hover: hover) and (pointer: fine)').matches && !reduceMotion) {
        const cursorLabel = $('.cursor__label', cursor);
        let x = -100, y = -100, cx = -100, cy = -100;
        window.addEventListener('mousemove', (e) => { x = e.clientX; y = e.clientY; }, { passive: true });
        document.addEventListener('mouseleave', () => cursor.classList.add('is-hidden'));
        document.addEventListener('mouseenter', () => cursor.classList.remove('is-hidden'));

        const loop = () => {
            cx += (x - cx) * 0.2;
            cy += (y - cy) * 0.2;
            cursor.style.setProperty('--x', `${cx}px`);
            cursor.style.setProperty('--y', `${cy}px`);
            requestAnimationFrame(loop);
        };
        loop();

        document.addEventListener('mouseover', (e) => {
            const target = e.target.closest('[data-cursor]');
            cursor.classList.toggle('has-label', Boolean(target));
            cursorLabel.textContent = target ? target.dataset.cursor : '';
        });
    }

    /* ---------- 10a. Filter kategori ---------- */
    $$('[data-filter-group]').forEach((group) => {
        const list = $('[data-filter-list]');
        if (!list) return;
        group.addEventListener('click', (e) => {
            const button = e.target.closest('[data-filter]');
            if (!button) return;
            $$('[data-filter]', group).forEach((b) => b.classList.toggle('is-active', b === button));
            const value = button.dataset.filter;
            $$('[data-filter-item]', list).forEach((item, i) => {
                const show = value === 'all' || item.dataset.filterItem === value;
                item.classList.toggle('is-filtered-out', !show);
                if (show) {
                    item.classList.remove('is-in');
                    item.style.transitionDelay = `${i * 40}ms`;
                    requestAnimationFrame(() => requestAnimationFrame(() => item.classList.add('is-in')));
                }
            });
            buildStations();
            requestUpdate();
        });
    });

    /* ---------- 10b. Carousel galeri proyek ---------- */
    $$('[data-carousel]').forEach((carousel) => {
        const track = $('[data-carousel-track]', carousel);
        const slides = $$('[data-carousel-slide]', carousel);
        const dots = $$('[data-carousel-dot]', carousel);
        const prev = $('[data-carousel-prev]', carousel);
        const next = $('[data-carousel-next]', carousel);
        const counter = $('[data-carousel-current]', carousel);
        let current = 0;

        const goTo = (index) => {
            const i = clamp(index, 0, slides.length - 1);
            const padding = parseFloat(getComputedStyle(track).paddingLeft);
            track.scrollTo({ left: slides[i].offsetLeft - padding, behavior: reduceMotion ? 'auto' : 'smooth' });
        };

        // Slide aktif = slide yang tepi kirinya paling dekat dengan posisi scroll.
        const sync = () => {
            const padding = parseFloat(getComputedStyle(track).paddingLeft);
            const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
            current = atEnd ? slides.length - 1 : slides.reduce((best, slide, i) => (
                Math.abs(slide.offsetLeft - padding - track.scrollLeft) < Math.abs(slides[best].offsetLeft - padding - track.scrollLeft) ? i : best
            ), 0);
            slides.forEach((slide, i) => slide.classList.toggle('is-current', i === current));
            dots.forEach((dot, i) => dot.classList.toggle('is-active', i === current));
            if (counter) counter.textContent = String(current + 1).padStart(2, '0');
            if (prev) prev.disabled = current === 0;
            if (next) next.disabled = current === slides.length - 1;
        };

        let syncFrame;
        track.addEventListener('scroll', () => { cancelAnimationFrame(syncFrame); syncFrame = requestAnimationFrame(sync); }, { passive: true });
        prev?.addEventListener('click', () => goTo(current - 1));
        next?.addEventListener('click', () => goTo(current + 1));
        dots.forEach((dot) => dot.addEventListener('click', () => goTo(Number(dot.dataset.carouselDot))));
        track.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') { e.preventDefault(); goTo(current + 1); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); goTo(current - 1); }
        });

        // Geser dengan mouse (drag). Di layar sentuh, geser bawaan browser yang dipakai.
        let startX = 0, startScroll = 0, dragging = false, moved = false;
        track.addEventListener('pointerdown', (e) => {
            if (e.pointerType !== 'mouse') return;
            dragging = true; moved = false;
            startX = e.clientX; startScroll = track.scrollLeft;
            track.setPointerCapture(e.pointerId);
        });
        track.addEventListener('pointermove', (e) => {
            if (!dragging) return;
            const dx = e.clientX - startX;
            if (Math.abs(dx) > 4) { moved = true; track.classList.add('is-dragging'); }
            track.scrollLeft = startScroll - dx;
        });
        const endDrag = () => {
            if (!dragging) return;
            dragging = false;
            track.classList.remove('is-dragging');
            if (moved) goTo(current);
        };
        track.addEventListener('pointerup', endDrag);
        track.addEventListener('pointercancel', endDrag);

        sync();
    });

    /* ---------- 10c. Salin email ---------- */
    $$('[data-copy]').forEach((button) => {
        button.addEventListener('click', async () => {
            const original = button.textContent;
            try {
                await navigator.clipboard.writeText(button.dataset.copy);
                button.textContent = 'Tersalin ✓';
            } catch {
                button.textContent = 'Gagal menyalin';
            }
            setTimeout(() => { button.textContent = original; }, 1800);
        });
    });
})();
