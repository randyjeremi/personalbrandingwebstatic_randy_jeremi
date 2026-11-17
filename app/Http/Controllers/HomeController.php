<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Halaman Beranda: ringkasan profil, karya unggulan, keahlian, dan artikel terbaru.
     */
    public function index(): View
    {
        // Ambil 3 karya unggulan dari data portofolio.
        $projects = collect(PortfolioController::projects())
            ->where('featured', true)
            ->take(3)
            ->values();

        // Ambil 3 artikel terbaru (diurutkan dari tanggal terbaru).
        $posts = collect(BlogController::posts())
            ->sortByDesc('date')
            ->take(3)
            ->values();

        // Data tampilan keahlian. Judul & deskripsi diambil dari lang/{bahasa}/home.php.
        $services = collect([
            ['key' => 'branding', 'color' => 'yellow', 'variant' => 'rings', 'skills' => ['Logo Design', 'Visual Identity', 'Art Direction', 'Creative Strategy']],
            ['key' => 'uiux', 'color' => 'orange', 'variant' => 'bars', 'skills' => ['User Interface Design', 'Landing Pages', 'User Experience', 'Figma']],
            ['key' => 'motion', 'color' => 'red', 'variant' => 'lines', 'skills' => ['After Effects', 'Typography', '3D', 'Storytelling']],
            ['key' => 'ai', 'color' => 'blue', 'variant' => 'dots', 'skills' => ['Generative AI', 'Digital Marketing', 'Python', 'Machine Learning']],
        ])->map(fn (array $service) => array_merge($service, __("home.services.{$service['key']}")));

        $stats = AboutController::stats();

        $marquee = ['Branding', 'Visual Identity', 'UI/UX Design', 'Landing Pages', 'Motion Graphics', 'Art Direction', 'Adobe Illustrator', 'Adobe Photoshop', 'After Effects', 'Generative AI'];

        return view('home', compact('projects', 'posts', 'services', 'stats', 'marquee'));
    }
}
