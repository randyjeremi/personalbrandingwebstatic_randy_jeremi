# Personal Branding Portfolio - Randy Jeremi

[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/randyjeremi/personalbrandingwebstatic_randy_jeremi?quickstart=1)

A multidisciplinary creative portfolio showcasing selected works in Graphic Design, UI/UX Design, Web Development, and Art Direction. Exploring the intersection of visual creativity, digital experiences, and technology through thoughtful design and creative experimentation.

---

Website personal branding berbasis **Laravel** untuk tugas AFL-1 Web Development.
Website ini memperkenalkan profil, pengalaman, keahlian, portofolio, dan tulisan blog Randy Jeremi, seorang Graphic & UI/UX Designer di Surabaya.

**Konsep desain:** gaya *Swiss / signage subway* (tipografi grotesk besar, lencana bulat berwarna seperti simbol jalur kereta, panah tebal, garis pemisah) digabung dengan layout dan motion ala studio desain modern: scroll halus, animasi muncul, transisi garis yang berubah menjadi panel, dan kartu bertumpuk.

**Fitur tambahan:**
- 🌐 **3 bahasa:** Indonesia, English, dan 中文 (Mandarin), mencakup seluruh teks, termasuk isi proyek dan artikel blog.
- 🎨 **3 tema:** Terang, Gelap, dan Kontras Tinggi (untuk aksesibilitas).

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
| Ganti bahasa | `/lang/{id\|en\|zh}` | Menyimpan bahasa pilihan, lalu kembali ke halaman sebelumnya |
| 404 | (URL tidak dikenal) | Halaman error dengan desain yang sama |

## Penerapan Fitur Laravel

| Fitur | Lokasi | Penjelasan |
|---|---|---|
| **Routing** | `routes/web.php` | Semua halaman memakai *named route* (`home`, `about`, `portfolio.index`, `portfolio.show`, `blog.index`, `blog.show`, `contact`, `locale.switch`). Detail blog/portofolio memakai parameter `{slug}`; route bahasa dibatasi dengan `whereIn()`. |
| **Controller** | `app/Http/Controllers/` | `HomeController`, `AboutController`, `PortfolioController`, `BlogController`, `ContactController`, `LocaleController`. Data dummy disimpan sebagai array di controller, lalu dikirim ke view dengan `compact()`. Slug yang tidak ada → `abort(404)`. |
| **Middleware** | `app/Http/Middleware/SetLocale.php` | Membaca bahasa dari session di setiap request, lalu memasang `App::setLocale()` dan `Carbon::setLocale()`. Didaftarkan di `bootstrap/app.php`. |
| **Localization** | `lang/{id,en,zh}/` | Semua teks memakai `__('file.kunci')`. Controller menyimpan data yang sama di semua bahasa (slug, warna, tahun), sedangkan teksnya diambil dari file `lang`. |
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
| `<x-preferences>` | Header & menu: pilihan bahasa dan tema |
| `<x-stat>`, `<x-avatar>`, `<x-marquee>`, `<x-arrow>`, `<x-theme-icon>` | Elemen kecil yang dipakai berulang |

Data identitas yang dipakai banyak komponen (nama, email, media sosial, menu) ada di **`config/site.php`** dan dipanggil dengan `config('site.xxx')`.

## Struktur Penting

```
app/Http/Controllers/     ← logika & data dummy
app/Http/Middleware/      ← SetLocale (bahasa aktif)
config/site.php           ← identitas, kontak, menu, daftar bahasa & tema
lang/id, lang/en, lang/zh ← semua teks dalam 3 bahasa
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

> Website tidak memakai database (data dummy ada di controller). Session disimpan sebagai file (`SESSION_DRIVER=file`), jadi tidak perlu menjalankan migrasi.

Menjalankan test (mengecek semua halaman di ketiga bahasa dan halaman 404):

```bash
php artisan test
```

## Menjalankan di GitHub Codespaces (tanpa install apa pun)

1. Klik tombol **Open in GitHub Codespaces** di atas, atau buka repo lalu pilih **Code → Codespaces → Create codespace on main**.
2. Tunggu sekitar 1–3 menit. Codespace otomatis menjalankan `composer install`, membuat `.env` dan `APP_KEY`, lalu menyalakan server Laravel di port **8000**.
3. Website terbuka di tab baru. Kalau tidak terbuka otomatis, buka tab **Ports**, lalu klik ikon 🌐 di baris port **8000 (Website)**.
4. Agar link bisa dibuka orang lain (misalnya dosen): di tab **Ports**, klik kanan port 8000, pilih **Port Visibility → Public**, lalu salin URL-nya.

Konfigurasinya ada di folder `.devcontainer/`:
- `devcontainer.json`: image PHP 8.4 dan port 8000.
- `setup.sh`: persiapan sekali jalan.
- `start.sh`: menyalakan server setiap kali Codespace aktif.

Codespace berhenti otomatis setelah sekitar 30 menit tidak dipakai. Buka lagi dari **Code → Codespaces**, dan server akan menyala kembali dengan sendirinya. Akun GitHub gratis mendapat kuota sekitar 60 jam per bulan.

| File | Fungsi |
|---|---|
| `Dockerfile` | Membangun image: install dependency dengan Composer, lalu menjalankan Laravel di PHP 8.4 |
| `docker/start.sh` | Saat server menyala: cache config/route/view, lalu `php artisan serve` di port dari Render |
| `render.yaml` | Konfigurasi layanan Render (paket gratis, region Singapura, health check `/up`, environment variable) |
| `.dockerignore` | File yang tidak ikut ke image (`.env`, `vendor`, `assets`, dll.) |

## Multi Bahasa

1. Pengunjung menekan tombol **ID / EN / 中文** di header (atau di menu pada layar kecil).
2. Tombol mengarah ke route `/lang/{kode}`. `LocaleController` menyimpan kode bahasa ke **session**, lalu kembali ke halaman sebelumnya.
3. Middleware `SetLocale` membaca session di setiap request dan memasang bahasa aktif.
4. View menampilkan teks dengan `__('site.nav.home')`, `__('portfolio.projects.slug.title')`, dan seterusnya. Laravel otomatis mengambil teks dari `lang/{bahasa-aktif}/`.
5. Format tanggal ikut bahasa melalui `Carbon::translatedFormat()` (misalnya "02 Mei 2026", "May 2, 2026", "2026年5月2日").

Menambah bahasa baru cukup dengan membuat folder `lang/{kode}/` berisi file yang sama, lalu menambahkan kodenya di `config/site.php` → `locales`.

## Tema (Terang / Gelap / Kontras)

- Semua warna di `public/css/style.css` memakai **CSS custom properties** (token) seperti `--bg`, `--fg`, `--block`, dan `--muted`. Nilainya didefinisikan ulang untuk `[data-theme="dark"]` dan `[data-theme="contrast"]`.
- Script kecil di `<head>` memasang tema **sebelum halaman tampil**, supaya tidak berkedip. Urutan pemilihannya: pilihan tersimpan → pengaturan kontras tinggi sistem → mode gelap sistem → terang.
- Tombol tema (`main.js`) mengganti atribut `data-theme` di `<html>` dan menyimpan pilihan ke `localStorage`.
- **Tema kontras** memakai hitam-putih murni dengan aksen kuning, garis tepi tegas, garis bawah pada link, dan outline fokus yang lebih tebal.

## Mengganti Konten

- **Foto profil:** simpan foto di `public/images/profile.jpg`. Jika belum ada, avatar inisial "RJ" yang tampil.
- **Gambar proyek:** taruh file di `public/images/portfolio/{slug}/` dengan nama berurutan (`01`, `02`, ...). File `01` menjadi cover, semua file tampil di carousel. Daftar gambar dibaca otomatis oleh `PortfolioController::gallery()`.
- **Gambar artikel:** isi kolom `'image'` di `BlogController`. Jika `null`, ilustrasi poster SVG yang tampil.
- **Email & media sosial:** ubah di `config/site.php`.
- **Teks (semua bahasa):** ubah di `lang/id/`, `lang/en/`, dan `lang/zh/`. Contohnya, deskripsi proyek ada di `lang/{bahasa}/portfolio.php` dan artikel di `lang/{bahasa}/blog.php`.

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

- Menganalisis referensi desain (gaya Swiss/subway) menjadi konsep visual.
- Menyusun data profil dari LinkedIn pribadi saya ke dalam struktur array.
- Membantu membuat fitur multi bahasa dan tema, termasuk terjemahan teks ke Bahasa Inggris dan Mandarin.

Seluruh kode sudah saya pelajari dan dapat saya jelaskan, termasuk alur routing → controller → view, cara data dikirim ke Blade, cara kerja layout & components, serta logika animasinya.

## Sumber Data

Profil, pendidikan, pengalaman, skills, penghargaan, dan sertifikasi diambil dari profil LinkedIn Randy Jeremi. Proyek portofolio adalah karya asli Randy Jeremi, sedangkan isi artikel blog adalah data dummy untuk keperluan tugas.
