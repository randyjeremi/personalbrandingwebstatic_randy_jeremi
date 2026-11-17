# Personal Branding Portfolio - Randy Jeremi

A multidisciplinary creative portfolio showcasing selected works in Graphic Design, UI/UX Design, Web Development, and Art Direction. Exploring the intersection of visual creativity, digital experiences, and technology through thoughtful design and creative experimentation.

---

Website personal branding berbasis **Laravel** untuk tugas AFL-1 Web Development.
Website ini memperkenalkan profil, pengalaman, keahlian, portofolio, dan tulisan blog Randy Jeremi, seorang Graphic & UI/UX Designer di Surabaya.

**Konsep desain:** gaya *Swiss / signage subway* (tipografi grotesk besar, lencana bulat berwarna seperti simbol jalur kereta, panah tebal, garis pemisah) digabung dengan layout dan motion ala studio desain modern: scroll halus, animasi muncul, transisi garis yang berubah menjadi panel, dan kartu bertumpuk.

---

## Halaman

| Halaman | URL | Isi |
|---|---|---|
| Beranda | `/` | Nama, avatar, tagline, bidang keahlian, karya unggulan, artikel terbaru, tombol ke Portofolio/Blog/About |
| Tentang | `/about` | Profil, pendidikan, pengalaman, skills, penghargaan, sertifikasi |
| Portofolio | `/portfolio` | 6 proyek + filter kategori |
| Detail proyek | `/portfolio/{slug}` | Carousel galeri, detail proyek, teknologi, proyek berikutnya |
| Blog | `/blog` | 5 artikel dummy + filter kategori |
| Detail artikel | `/blog/{slug}` | Isi artikel ("Baca Selengkapnya"), artikel sebelum/sesudah |
| Kontak | `/contact` | Email, LinkedIn, GitHub, lokasi, status |
| 404 | (URL tidak dikenal) | Halaman error dengan desain yang sama |

## Penerapan Fitur Laravel

| Fitur | Lokasi | Penjelasan |
|---|---|---|
| **Routing** | `routes/web.php` | Semua halaman memakai *named route* (`home`, `about`, `portfolio.index`, `portfolio.show`, `blog.index`, `blog.show`, `contact`). Detail blog/portofolio memakai parameter `{slug}`. |
| **Controller** | `app/Http/Controllers/` | `HomeController`, `AboutController`, `PortfolioController`, `BlogController`, `ContactController`. Data dummy disimpan sebagai array di controller, lalu dikirim ke view dengan `compact()`. Slug yang tidak ada → `abort(404)`. |
| **View** | `resources/views/` | Setiap halaman punya file view sendiri (`home`, `about`, `portfolio/index`, `portfolio/show`, `blog/index`, `blog/show`, `contact`, `errors/404`). |
| **Blade** | Semua view | `{{ }}`, `@foreach`, `@forelse`, `@if`, `@isset`, `@switch`, `@class`, `@php`, `$loop->first`, `@section/@yield`. |
| **Layout** | `resources/views/layouts/app.blade.php` | Struktur halaman bersama (head, navbar, rail samping, footer, script). Halaman memakai `@extends('layouts.app')`. |
| **Components** | `resources/views/components/` | Komponen Blade yang dipakai ulang (lihat tabel di bawah). |

### Blade Components

| Komponen | Dipakai di |
|---|---|
| `<x-navbar>` | Layout: header, menu layar penuh |
| `<x-footer>` | Layout: CTA, daftar isi, kontak |
| `<x-side-rail>` | Layout: navigasi lencana + progress rute + jam |
| `<x-portfolio-card>` | Beranda, Portofolio |
| `<x-blog-card>` | Beranda, Blog, Detail artikel |
| `<x-carousel>` | Detail proyek (galeri gambar yang bisa digeser) |
| `<x-button>` | Hampir semua halaman |
| `<x-section-title>` | Judul dua tingkat di semua halaman |
| `<x-line-badge>` | Lencana bulat ala simbol jalur subway |
| `<x-poster>` | Ilustrasi SVG untuk proyek/artikel (atau foto jika `image` diisi) |
| `<x-timeline-item>` | Garis waktu pengalaman & pendidikan |
| `<x-stat>`, `<x-avatar>`, `<x-marquee>`, `<x-arrow>` | Elemen kecil yang dipakai berulang |

Data identitas yang dipakai banyak komponen (nama, email, media sosial, menu) ada di **`config/site.php`** dan dipanggil dengan `config('site.xxx')`.

## Struktur Penting

```
app/Http/Controllers/     ← logika & data dummy
config/site.php           ← identitas, kontak, menu navigasi
routes/web.php            ← routing
resources/views/
├── layouts/app.blade.php ← layout utama
├── components/           ← Blade components
├── portfolio/, blog/     ← halaman daftar & detail
└── home, about, contact, errors/404
public/css/style.css      ← seluruh styling + responsif
public/js/main.js         ← motion & interaksi
```

## Cara Menjalankan

Kebutuhan: **PHP 8.3+** (dengan extension `openssl`, `mbstring`, `fileinfo`, `pdo_sqlite`, `curl`, `zip`) dan **Composer**. Node.js **tidak wajib** karena CSS & JS ditulis langsung di folder `public/`.

```bash
git clone <url-repository>
cd personalbrandingwebstatic_randy_jeremi
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Buka `http://localhost:8000`.

> Website tidak memakai database (data dummy ada di controller). Jika muncul error terkait session/database, jalankan `php artisan migrate` (membuat file SQLite bawaan Laravel).

## Mengganti Konten

- **Foto profil:** simpan foto di `public/images/profile.jpg`. Jika belum ada, avatar inisial "RJ" yang tampil.
- **Gambar proyek:** taruh file di `public/images/portfolio/{slug}/` dengan nama berurutan (`01`, `02`, ...). File `01` menjadi cover, semua file tampil di carousel. Daftar gambar dibaca otomatis oleh `PortfolioController::gallery()`.
- **Gambar artikel:** isi kolom `'image'` di `BlogController`. Jika `null`, ilustrasi poster SVG yang tampil.
- **Email & media sosial:** ubah di `config/site.php`.

## Motion & Interaksi (`public/js/main.js`)

- Scroll halus dengan [Lenis](https://github.com/darkroomengineering/lenis) (dari CDN). Website tetap berjalan normal jika gagal dimuat.
- Tirai transisi antar halaman.
- Animasi teks per baris dan kartu yang muncul bergantian (IntersectionObserver).
- Transisi garis jalur → kotak → panel layar penuh yang mengikuti posisi scroll (Beranda).
- Kartu keahlian bertumpuk (CSS `position: sticky`) yang mengecil saat tertimpa.
- Progress scroll berbentuk rute kereta dengan titik "stasiun" per section.
- Angka statistik yang menghitung naik, parallax ringan, kursor custom, filter kategori, tombol salin email.
- Header otomatis berganti warna di section gelap/terang (`mix-blend-mode: difference`).
- Menghormati pengaturan **prefers-reduced-motion**: animasi dimatikan untuk pengguna yang memintanya.

## Responsif

Tata letak menyesuaikan desktop, tablet, dan smartphone: grid menjadi satu kolom, rail samping disembunyikan, tombol menu pindah ke kanan atas, dan efek berat (transisi garis → panel) diganti versi statis di layar kecil.

## Penggunaan AI

Proyek ini dikerjakan dengan bantuan **Claude (Anthropic)** sebagai asisten:

- Menganalisis referensi desain (website brandappart.com dan referensi gaya Swiss/subway) menjadi konsep visual.
- Menyusun data profil dari LinkedIn pribadi saya ke dalam struktur array.
- Membantu menulis kode controller, view, komponen Blade, CSS, dan JavaScript, serta draf artikel blog dummy.

Seluruh kode sudah saya pelajari dan dapat saya jelaskan, termasuk alur routing → controller → view, cara data dikirim ke Blade, cara kerja layout & components, serta logika animasinya.

## Sumber Data

Profil, pendidikan, pengalaman, skills, penghargaan, dan sertifikasi diambil dari profil LinkedIn Randy Jeremi. Proyek portofolio adalah karya asli Randy Jeremi, sedangkan isi artikel blog adalah data dummy untuk keperluan tugas.
