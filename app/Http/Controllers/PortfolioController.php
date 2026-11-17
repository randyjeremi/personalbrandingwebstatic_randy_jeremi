<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    /**
     * Daftar semua karya.
     */
    public function index()
    {
        $projects = collect(self::projects());

        // Kategori unik untuk tombol filter.
        $categories = $projects->pluck('category')->unique()->values();

        return view('portfolio.index', compact('projects', 'categories'));
    }

    /**
     * Detail satu karya berdasarkan slug di URL.
     */
    public function show(string $slug)
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
     * Gambar tiap proyek disimpan di public/images/portfolio/{slug}/ dan diberi nama berurutan
     * (01, 02, 03, ...). File pertama (01) dipakai sebagai cover, semuanya tampil di carousel.
     * Untuk menambah gambar, cukup taruh file baru di folder tersebut.
     */
    public static function projects(): array
    {
        $projects = [
            [
                'slug' => 'ah-bang-kopitiam-logo',
                'title' => 'AH BANG Kopitiam Logo Design',
                'client' => 'Delitopia Group',
                'category' => 'Branding',
                'year' => '2025',
                'role' => 'Graphic & Brand Designer',
                'color' => 'red',
                'variant' => 'rings',
                'featured' => true,
                'summary' => 'Identitas brand bergaya vintage untuk kopitiam, terinspirasi dari kedai kopi tradisional Melayu-Tionghoa dan papan nama heritage.',
                'description' => [
                    'Saya merancang identitas brand bergaya vintage untuk AH BANG KOPITIAM, terinspirasi dari kedai kopi tradisional Melayu-Tionghoa dan papan nama heritage yang penuh nostalgia.',
                    'Logonya memadukan emblem ornamental, ilustrasi gambar tangan seorang pria yang sedang menikmati kopi, dan tipografi serif klasik untuk menyampaikan kehangatan, keaslian, dan warisan budaya. Palet warna burgundy, krem, hijau tua, dan emas dipilih dengan cermat untuk menciptakan karakter visual yang tak lekang oleh waktu.',
                    'Tujuan keseluruhannya adalah menjaga pesona nostalgia kopitiam tradisional sekaligus membangun identitas yang khas dan mudah dikenali. Identitas ini juga diterapkan pada materi promosi seperti poster dan konten feed media sosial.',
                ],
                'tech' => ['Adobe Illustrator', 'Logo Design', 'Brand Identity', 'Illustration'],
            ],
            [
                'slug' => 'linkara-branding',
                'title' => 'Linkara Brandketing Agency Branding',
                'client' => 'Linkara Brandketing Agency',
                'category' => 'Branding',
                'year' => '2024',
                'role' => 'Graphic & Branding Designer',
                'color' => 'blue',
                'variant' => 'dots',
                'featured' => true,
                'summary' => 'Identitas brand dan desain digital untuk agensi branding & marketing yang menjembatani UMKM menuju kesuksesan.',
                'description' => [
                    'Proyek ini memperkuat kehadiran digital Linkara melalui identitas brand yang segar dan desain digital yang memikat.',
                    'Linkara Brandketing Agency adalah agensi branding & marketing yang menjembatani UMKM dengan potensi kesuksesannya. Linkara berfokus membantu bisnis lokal membangun identitas, memperkuat brand, dan terhubung dengan audiens secara bermakna.',
                    'Saya mengerjakan identitas visual dan aset desain digitalnya, dari logo sampai penerapannya di berbagai media, sehingga Linkara tampil konsisten sebagai agensi yang profesional dan modern.',
                ],
                'tech' => ['Adobe Illustrator', 'Figma', 'Brand Identity', 'Logo Design'],
            ],
            [
                'slug' => 'astra-daihatsu-blitar-landing-page',
                'title' => 'Astra Daihatsu Blitar Landing Page',
                'client' => 'Astra Daihatsu Blitar',
                'category' => 'UI/UX',
                'year' => '2024',
                'role' => 'UI/UX Designer',
                'color' => 'orange',
                'variant' => 'bars',
                'featured' => false,
                'summary' => 'Redesain landing page untuk meningkatkan pengalaman pengguna dan mendorong konversi penjualan.',
                'description' => [
                    'Meningkatkan pengalaman pengguna untuk konversi yang maksimal.',
                    'Astra Daihatsu Blitar menghadapi tantangan berupa website lama yang tidak menonjolkan lini produknya secara efektif. Desain UI/UX sebelumnya kurang memiliki elemen yang mengajak pengguna berinteraksi, sehingga bounce rate tinggi dan tingkat konversi rendah.',
                    'Kehadiran digitalnya membutuhkan perombakan menyeluruh untuk memperbaiki persepsi brand dan meningkatkan penjualan. Saya merancang ulang landing page-nya di Figma dengan fokus pada penyajian produk yang lebih jelas dan alur yang mengarahkan pengunjung untuk mengambil tindakan.',
                ],
                'tech' => ['Figma', 'UI Design', 'UX Design', 'Landing Page'],
            ],
            [
                'slug' => 'amara-professional-social-media',
                'title' => 'AMARA Professional Social Media Design',
                'client' => 'ALVA Technology Resolution',
                'category' => 'Graphic Design',
                'year' => '2026',
                'role' => 'Graphic Designer',
                'color' => 'pink',
                'variant' => 'lines',
                'featured' => true,
                'summary' => 'Konten media sosial untuk promosi hair dryer AMARA Professional dengan visual yang modern, premium, dan profesional.',
                'description' => [
                    'Perancangan konten media sosial untuk AMARA Professional dengan fokus pada promosi produk hair dryer melalui pendekatan visual yang modern, premium, dan profesional.',
                    'Desainnya menggabungkan fotografi produk bergaya clean studio, komposisi dinamis, pencahayaan lembut, serta palet warna yang elegan untuk menciptakan visual yang menarik dan berorientasi pada produk.',
                    'Fokus utama proyek ini adalah menghadirkan representasi produk yang detail, akurat, dan nyaman dipandang, sekaligus mengoptimalkan komposisi visual untuk menyampaikan informasi dan keunggulan produk secara efektif.',
                ],
                'tech' => ['Adobe Illustrator', 'Adobe Photoshop', 'Social Media Design', 'Product Visual'],
            ],
            [
                'slug' => 'gms-bizcon-branding',
                'title' => 'GMS Bizcon Branding',
                'client' => 'Proyek Personal',
                'category' => 'Branding',
                'year' => '2024',
                'role' => 'Graphic & Branding Designer',
                'color' => 'yellow',
                'variant' => 'arrow',
                'featured' => false,
                'summary' => 'Identitas yang lebih kuat, modern, dan inovatif untuk komunitas bisnis & karier GMS Bizcon.',
                'description' => [
                    'GMS Bizcon (Business Connection) adalah komunitas yang menjadi bagian dari Gereja Mawar Sharon (GMS). Komunitas ini menghubungkan jemaat satu sama lain dalam hal bisnis dan pekerjaan.',
                    'Tujuan proyek ini adalah memberi GMS Bizcon identitas yang lebih kuat, lebih modern, dan inovatif, sekaligus menarik lebih banyak orang untuk bergabung dengan komunitasnya.',
                ],
                'tech' => ['Figma', 'Adobe Illustrator', 'Brand Identity', 'Logo Design'],
            ],
            [
                'slug' => 'happyfresh-ui-ux-refresh',
                'title' => 'HappyFresh UI/UX Refresh',
                'client' => 'Proyek UI/UX Purwadhika',
                'category' => 'UI/UX',
                'year' => '2024',
                'role' => 'UI/UX Designer',
                'color' => 'green',
                'variant' => 'dots',
                'featured' => false,
                'summary' => 'Penyegaran UI/UX aplikasi HappyFresh untuk mempermudah navigasi dan akses informasi bagi pengguna.',
                'description' => [
                    'Tujuan proyek ini adalah meningkatkan navigasi pengguna dan aksesibilitas informasi di aplikasi HappyFresh.',
                    'Pertama, pengguna kesulitan menemukan fitur penting sehingga fungsi-fungsi utama sulit diakses.',
                    'Kedua, pengguna terbatas dalam mengambil keputusan karena tidak bisa menilai kelayakan atau kenyamanan transaksi berdasarkan jarak.',
                    'Ketiga, terdapat kesenjangan informasi: detail produk kurang lengkap sehingga konsumen sulit membuat keputusan pembelian yang tepat.',
                ],
                'tech' => ['Figma', 'UI Design', 'UX Design', 'Mobile App'],
            ],
        ];

        // Tambahkan daftar gambar (gallery) dan cover (image) untuk setiap proyek.
        return array_map(function (array $project) {
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
