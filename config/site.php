<?php

/*
|--------------------------------------------------------------------------
| Identitas Website
|--------------------------------------------------------------------------
| Data identitas yang dipakai berulang di banyak halaman (navbar, footer,
| kontak, dsb). Dipanggil di Blade dengan config('site.xxx').
| Warna mengacu ke "warna jalur" di public/css/style.css
| (yellow, orange, red, green, blue, pink, ink).
*/

return [

    'name' => 'Randy Jeremi',
    'first_name' => 'Randy',
    'last_name' => 'Jeremi',
    'initials' => 'RJ',
    'role' => 'Graphic & UI/UX Designer',
    'tagline' => 'Saya merancang identitas visual, antarmuka, dan motion yang membuat brand mudah dikenali dan mudah dipilih.',
    'location' => 'Surabaya, Indonesia',
    'timezone' => 'Asia/Jakarta',
    'status' => 'Open to work',
    'work_modes' => 'On-site · Hybrid · Remote',

    'email' => 'randyjestepe06@gmail.com',

    // Foto di public/images/profile.jpg. Jika file tidak ada, avatar inisial "RJ" yang tampil.
    'photo' => 'images/profile.jpg',

    'socials' => [
        ['name' => 'LinkedIn', 'handle' => 'in/randy-jeremi', 'url' => 'https://www.linkedin.com/in/randy-jeremi-260296287/', 'letter' => 'in', 'color' => 'blue'],
        ['name' => 'Behance', 'handle' => 'randyjeremy', 'url' => 'https://www.behance.net/randyjeremy', 'letter' => 'Be', 'color' => 'orange'],
        ['name' => 'Instagram', 'handle' => '@randy_jrmy', 'url' => 'https://www.instagram.com/randy_jrmy/', 'letter' => 'IG', 'color' => 'pink'],
        ['name' => 'Pinterest', 'handle' => '@randy_jrmy', 'url' => 'https://id.pinterest.com/randy_jrmy/_created/', 'letter' => 'P', 'color' => 'red'],
        ['name' => 'GitHub', 'handle' => '@randyjeremi', 'url' => 'https://github.com/randyjeremi?tab=repositories', 'letter' => 'G', 'color' => 'ink'],
    ],

    // Navigasi utama: dipakai navbar, menu, rail samping, dan footer.
    'nav' => [
        ['label' => 'Beranda', 'route' => 'home', 'match' => 'home', 'letter' => '1', 'color' => 'yellow'],
        ['label' => 'Tentang', 'route' => 'about', 'match' => 'about', 'letter' => '2', 'color' => 'orange'],
        ['label' => 'Portofolio', 'route' => 'portfolio.index', 'match' => 'portfolio.*', 'letter' => '3', 'color' => 'red'],
        ['label' => 'Blog', 'route' => 'blog.index', 'match' => 'blog.*', 'letter' => '4', 'color' => 'green'],
        ['label' => 'Kontak', 'route' => 'contact', 'match' => 'contact', 'letter' => '5', 'color' => 'blue'],
    ],

];
