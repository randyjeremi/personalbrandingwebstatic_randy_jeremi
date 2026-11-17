<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    /**
     * Halaman Tentang Saya: profil, pendidikan, pengalaman, skills, penghargaan, sertifikasi.
     * Data diambil dari profil LinkedIn Randy Jeremi.
     */
    public function index()
    {
        $profile = [
            'Saya Randy Jeremi, desainer grafis dan UI/UX asal Medan yang sekarang berkarya dan kuliah di Surabaya. Saat ini saya menempuh S1 Informatika di Universitas Ciputra Surabaya sambil bekerja sebagai Graphic Designer.',
            'Latar belakang Rekayasa Perangkat Lunak di SMK Telkom 1 Medan dan program UI/UX di Purwadhika membuat saya terbiasa melihat desain dari dua sisi: bagaimana sesuatu terlihat, dan bagaimana sesuatu bekerja.',
            'Saya senang mengerjakan identitas visual, materi promosi, landing page, dan motion graphics, serta memanfaatkan AI di dalam proses kreatif agar hasilnya efisien sekaligus tetap selaras dengan arah brand.',
        ];

        $experiences = [
            [
                'title' => 'Graphic Designer',
                'org' => 'ALVA Technology Resolution',
                'type' => 'Freelance · Remote',
                'period' => 'Feb 2026 — Sekarang',
                'color' => 'blue',
                'desc' => 'Bekerja layaknya design lab: mengintegrasikan AI ke proses kreatif untuk menghasilkan visual promosi yang efisien dan selaras dengan pertumbuhan brand.',
                'tags' => ['Adobe Photoshop', 'Adobe Illustrator', 'Artificial Intelligence', 'Digital Marketing'],
            ],
            [
                'title' => 'Technical Crew',
                'org' => 'IDEAfest SUB 2026',
                'type' => 'Freelance · On-site',
                'period' => 'Agu 2026',
                'color' => 'orange',
                'points' => [
                    'Mendukung eksekusi teknis dan kesiapan operasional di berbagai sesi acara.',
                    'Membantu setup teknis, persiapan peralatan, kesiapan venue, dan troubleshooting di lokasi.',
                    'Berkoordinasi dengan tim event, kreatif, dan produksi sesuai timeline acara.',
                    'Memantau kondisi teknis saat sesi live dan merespons kendala dengan cepat.',
                ],
                'tags' => ['Project Management', 'Problem Solving', 'Technical Support', 'Teamwork'],
            ],
            [
                'title' => 'Graphic Designer',
                'org' => 'Delitopia Group',
                'type' => 'Full-time · On-site',
                'period' => 'Jan 2025 — Sekarang',
                'color' => 'yellow',
                'desc' => 'Membuat logo brand, desain promosi, dan beragam aset marketing dengan pendekatan yang berfokus pada pelanggan agar tetap menarik dan relevan.',
                'tags' => ['Image Design', 'User Experience', 'Online Graphics', 'Logo Design'],
            ],
            [
                'title' => 'Graphic Design Intern',
                'org' => 'Yelo Design Studio',
                'type' => 'Magang · Medan',
                'period' => 'Mei 2023 — Agu 2023',
                'color' => 'red',
                'desc' => 'Magang sebagai desainer grafis dan belajar alur kerja studio desain secara langsung.',
                'tags' => ['Landing Pages', 'Branding', 'Creative Development'],
            ],
        ];

        $education = [
            [
                'title' => 'S1 Informatika',
                'org' => 'Universitas Ciputra Surabaya',
                'type' => 'Bachelor\'s degree',
                'period' => 'Agu 2025 — Sekarang',
                'color' => 'green',
            ],
            [
                'title' => 'Job Connector UI/UX',
                'org' => 'Purwadhika Digital Technology School',
                'type' => 'Bootcamp · Surabaya',
                'period' => 'Mei 2024 — Agu 2024',
                'color' => 'pink',
                'desc' => 'Mempelajari UI/UX sesuai kebutuhan industri.',
            ],
            [
                'title' => 'Rekayasa Perangkat Lunak',
                'org' => 'SMK Telkom 1 Medan',
                'type' => 'High School Diploma',
                'period' => 'Jun 2021 — Mei 2024',
                'color' => 'blue',
                'desc' => 'Aktif di English Club.',
            ],
        ];

        $skills = [
            ['group' => 'Desain & Brand', 'color' => 'yellow', 'items' => ['Branding', 'Visual Identity', 'Logo Design', 'Art Direction', 'Creative Direction', 'Creative Strategy', 'Image Design', 'Online Graphics']],
            ['group' => 'UI/UX & Web', 'color' => 'orange', 'items' => ['User Interface Design', 'User Experience (UX)', 'Landing Pages', 'Web Design']],
            ['group' => 'Tools', 'color' => 'red', 'items' => ['Adobe Photoshop', 'Adobe Illustrator', 'After Effects', 'Figma']],
            ['group' => 'Data & AI', 'color' => 'blue', 'items' => ['Artificial Intelligence', 'Python', 'Machine Learning', 'Digital Marketing']],
            ['group' => 'Kerja Tim', 'color' => 'green', 'items' => ['Project Management', 'Problem Solving', 'Collaborative Problem Solving', 'Teamwork', 'Technical Support']],
        ];

        $awards = [
            ['title' => 'Best Technical Crew', 'issuer' => 'IDEAfest SUB 2026 & Youth Up', 'date' => 'Agu 2026', 'color' => 'orange', 'rank' => '★'],
            ['title' => 'Juara 3 Web Development Competition', 'issuer' => 'BEM FTI Universitas Tarumanagara · I/O Fest 2023 (Tim FROGTEL)', 'date' => 'Mei 2023', 'color' => 'green', 'rank' => '3'],
            ['title' => 'Juara 1 Web Design Tingkat Provinsi Sumatera Utara', 'issuer' => 'SAE Academy', 'date' => 'Jul 2021', 'color' => 'yellow', 'rank' => '1'],
        ];

        $certificates = [
            ['title' => 'Python, Pandas, Intro to SQL, Intro to Machine Learning', 'issuer' => 'Kaggle', 'date' => 'Nov 2026'],
            ['title' => 'Artificial Intelligence Fundamentals', 'issuer' => 'IBM SkillsBuild', 'date' => 'Des 2025'],
            ['title' => 'Digital Literacy', 'issuer' => 'IBM SkillsBuild', 'date' => 'Nov 2025'],
        ];

        $stats = self::stats();

        return view('about', compact('profile', 'experiences', 'education', 'skills', 'awards', 'certificates', 'stats'));
    }

    /**
     * Angka ringkas yang juga dipakai di Beranda.
     */
    public static function stats(): array
    {
        return [
            ['value' => 2021, 'suffix' => '', 'label' => 'Mulai belajar desain & web', 'color' => 'yellow'],
            ['value' => 4, 'suffix' => '', 'label' => 'Pengalaman profesional', 'color' => 'orange'],
            ['value' => 3, 'suffix' => '', 'label' => 'Penghargaan', 'color' => 'red'],
            ['value' => 3, 'suffix' => '+', 'label' => 'Sertifikasi', 'color' => 'blue'],
        ];
    }
}
