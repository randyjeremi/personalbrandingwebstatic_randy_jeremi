<?php

/*
|--------------------------------------------------------------------------
| Identitas Website
|--------------------------------------------------------------------------
| Data identitas yang dipakai berulang di banyak halaman (navbar, footer,
| kontak, dsb). Dipanggil di Blade dengan config('site.xxx').
| Teks yang perlu diterjemahkan (tagline, label menu, dll.) ada di folder lang/.
| Warna mengacu ke "warna jalur" di public/css/style.css
| (yellow, orange, red, green, blue, pink, ink).
*/

return [

    'name' => 'Randy Jeremi',
    'first_name' => 'Randy',
    'last_name' => 'Jeremi',
    'initials' => 'RJ',
    'timezone' => 'Asia/Jakarta',

    'email' => 'randyjestepe06@gmail.com',

    // Foto di public/images/profile.jpg. Jika file tidak ada, avatar inisial "RJ" yang tampil.
    'photo' => 'images/profile.jpg',

    // Bahasa yang tersedia: kode => label singkat di tombol.
    'locales' => [
        'id' => 'ID',
        'en' => 'EN',
        'zh' => '中文',
    ],

    // Tema yang tersedia (dipakai tombol tema dan atribut data-theme di <html>).
    'themes' => ['light', 'dark', 'contrast'],

    'socials' => [
        ['name' => 'LinkedIn', 'handle' => 'in/randy-jeremi', 'url' => 'https://www.linkedin.com/in/randy-jeremi-260296287/', 'letter' => 'in', 'color' => 'blue'],
        ['name' => 'Behance', 'handle' => 'randyjeremy', 'url' => 'https://www.behance.net/randyjeremy', 'letter' => 'Be', 'color' => 'orange'],
        ['name' => 'Instagram', 'handle' => '@randy_jrmy', 'url' => 'https://www.instagram.com/randy_jrmy/', 'letter' => 'IG', 'color' => 'pink'],
        ['name' => 'Pinterest', 'handle' => '@randy_jrmy', 'url' => 'https://id.pinterest.com/randy_jrmy/_created/', 'letter' => 'P', 'color' => 'red'],
        ['name' => 'GitHub', 'handle' => '@randyjeremi', 'url' => 'https://github.com/randyjeremi?tab=repositories', 'letter' => 'G', 'color' => 'ink'],
    ],

    // Navigasi utama: dipakai navbar, menu, rail samping, dan footer.
    // "key" dipakai untuk mengambil label terjemahan: __('site.nav.home'), dst.
    'nav' => [
        ['key' => 'home', 'route' => 'home', 'match' => 'home', 'letter' => '1', 'color' => 'yellow'],
        ['key' => 'about', 'route' => 'about', 'match' => 'about', 'letter' => '2', 'color' => 'orange'],
        ['key' => 'portfolio', 'route' => 'portfolio.index', 'match' => 'portfolio.*', 'letter' => '3', 'color' => 'red'],
        ['key' => 'blog', 'route' => 'blog.index', 'match' => 'blog.*', 'letter' => '4', 'color' => 'green'],
        ['key' => 'contact', 'route' => 'contact', 'match' => 'contact', 'letter' => '5', 'color' => 'blue'],
    ],

];
