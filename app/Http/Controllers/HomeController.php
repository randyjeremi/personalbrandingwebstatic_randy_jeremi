<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Halaman Beranda: ringkasan profil, karya unggulan, keahlian, dan artikel terbaru.
     */
    public function index()
    {
        // Ambil 3 karya unggulan dari data dummy portofolio.
        $projects = collect(PortfolioController::projects())
            ->where('featured', true)
            ->take(3)
            ->values();

        // Ambil 3 artikel terbaru (diurutkan dari tanggal terbaru).
        $posts = collect(BlogController::posts())
            ->sortByDesc('date')
            ->take(3)
            ->values();

        $services = [
            [
                'title' => 'Branding & Identitas Visual',
                'desc' => 'Logo, sistem visual, dan materi promosi yang konsisten di setiap titik sentuh, dari kemasan sampai feed media sosial.',
                'color' => 'yellow',
                'variant' => 'rings',
                'skills' => ['Logo Design', 'Visual Identity', 'Art Direction', 'Creative Strategy'],
            ],
            [
                'title' => 'UI/UX & Web Design',
                'desc' => 'Antarmuka dan landing page yang jelas alurnya, enak dipakai, dan dibangun dengan pemahaman teknis rekayasa perangkat lunak.',
                'color' => 'orange',
                'variant' => 'bars',
                'skills' => ['User Interface Design', 'Landing Pages', 'User Experience', 'Figma'],
            ],
            [
                'title' => 'Motion Graphics',
                'desc' => 'Animasi tipografi, poster bergerak, dan efek visual untuk konten yang berhenti di-scroll.',
                'color' => 'red',
                'variant' => 'lines',
                'skills' => ['After Effects', 'Typography', '3D', 'Storytelling'],
            ],
            [
                'title' => 'AI-Assisted Creative',
                'desc' => 'Memadukan AI ke dalam proses kreatif supaya produksi visual lebih cepat tanpa kehilangan arah brand.',
                'color' => 'blue',
                'variant' => 'dots',
                'skills' => ['Generative AI', 'Digital Marketing', 'Python', 'Machine Learning'],
            ],
        ];

        $stats = AboutController::stats();

        $marquee = ['Branding', 'Visual Identity', 'UI/UX Design', 'Landing Pages', 'Motion Graphics', 'Art Direction', 'Adobe Illustrator', 'Adobe Photoshop', 'After Effects', 'Generative AI'];

        return view('home', compact('projects', 'posts', 'services', 'stats', 'marquee'));
    }
}
