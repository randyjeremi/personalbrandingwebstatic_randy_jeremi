<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Daftar semua karya.
     */
    public function index(): View
    {
        $projects = collect(self::projects());

        // Kategori unik untuk tombol filter: [kode => label terjemahan].
        $categories = $projects->pluck('category_label', 'category')->unique();

        return view('portfolio.index', compact('projects', 'categories'));
    }

    /**
     * Detail satu karya berdasarkan slug di URL.
     */
    public function show(string $slug): View
    {
        $projects = collect(self::projects());
        $index = $projects->search(fn ($project) => $project['slug'] === $slug);

        if ($index === false) {
            abort(404);
        }

        $project = $projects[$index];
        // Karya berikutnya (kembali ke awal jika sudah yang terakhir).
        $next = $projects[($index + 1) % $projects->count()];

        return view('portfolio.show', compact('project', 'next', 'index'));
    }

    /**
     * Data portofolio.
     *
     * Controller menyimpan data yang sama di semua bahasa (slug, tahun, warna, tools).
     * Teks (judul, klien, peran, ringkasan, deskripsi) ada di lang/{bahasa}/portfolio.php.
     *
     * Gambar tiap proyek disimpan di public/images/portfolio/{slug}/ dan diberi nama berurutan
     * (01, 02, 03, ...). File pertama (01) dipakai sebagai cover, semuanya tampil di carousel.
     */
    public static function projects(): array
    {
        $projects = [
            [
                'slug' => 'ah-bang-kopitiam-logo',
                'category' => 'branding',
                'year' => '2025',
                'color' => 'red',
                'variant' => 'rings',
                'featured' => true,
                'tech' => ['Adobe Illustrator', 'Logo Design', 'Brand Identity', 'Illustration'],
            ],
            [
                'slug' => 'linkara-branding',
                'category' => 'branding',
                'year' => '2024',
                'color' => 'blue',
                'variant' => 'dots',
                'featured' => true,
                'tech' => ['Adobe Illustrator', 'Figma', 'Brand Identity', 'Logo Design'],
            ],
            [
                'slug' => 'astra-daihatsu-blitar-landing-page',
                'category' => 'uiux',
                'year' => '2024',
                'color' => 'orange',
                'variant' => 'bars',
                'featured' => false,
                'tech' => ['Figma', 'UI Design', 'UX Design', 'Landing Page'],
            ],
            [
                'slug' => 'amara-professional-social-media',
                'category' => 'graphic',
                'year' => '2026',
                'color' => 'pink',
                'variant' => 'lines',
                'featured' => true,
                'tech' => ['Adobe Illustrator', 'Adobe Photoshop', 'Social Media Design', 'Product Visual'],
            ],
            [
                'slug' => 'gms-bizcon-branding',
                'category' => 'branding',
                'year' => '2024',
                'color' => 'yellow',
                'variant' => 'arrow',
                'featured' => false,
                'tech' => ['Figma', 'Adobe Illustrator', 'Brand Identity', 'Logo Design'],
            ],
            [
                'slug' => 'happyfresh-ui-ux-refresh',
                'category' => 'uiux',
                'year' => '2024',
                'color' => 'green',
                'variant' => 'dots',
                'featured' => false,
                'tech' => ['Figma', 'UI Design', 'UX Design', 'Mobile App'],
            ],
        ];

        return array_map(function (array $project) {
            // Teks sesuai bahasa aktif: title, client, role, summary, description.
            $project = array_merge($project, __("portfolio.projects.{$project['slug']}"));
            $project['category_label'] = __("portfolio.categories.{$project['category']}");

            // Daftar gambar (gallery) dan cover (image).
            $project['gallery'] = self::gallery($project['slug']);
            $project['image'] = $project['gallery'][0] ?? null;

            return $project;
        }, $projects);
    }

    /**
     * Ambil semua file gambar di public/images/portfolio/{slug}, diurutkan berdasarkan nama.
     */
    private static function gallery(string $slug): array
    {
        $folder = public_path("images/portfolio/{$slug}");

        if (! File::isDirectory($folder)) {
            return [];
        }

        return collect(File::files($folder))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), ['avif', 'webp', 'jpg', 'jpeg', 'png']))
            ->map(fn ($file) => "images/portfolio/{$slug}/".$file->getFilename())
            ->sort()
            ->values()
            ->all();
    }
}
