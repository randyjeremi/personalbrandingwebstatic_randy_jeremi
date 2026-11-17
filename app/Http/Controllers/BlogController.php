<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Daftar artikel, diurutkan dari yang terbaru.
     */
    public function index(): View
    {
        $posts = collect(self::posts())->sortByDesc('date')->values();

        // Kategori unik untuk tombol filter: [kode => label terjemahan].
        $categories = $posts->pluck('category_label', 'category')->unique();

        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Halaman detail artikel ("Baca Selengkapnya").
     */
    public function show(string $slug): View
    {
        $posts = collect(self::posts())->sortByDesc('date')->values();
        $index = $posts->search(fn ($post) => $post['slug'] === $slug);

        if ($index === false) {
            abort(404);
        }

        $post = $posts[$index];
        $newer = $posts[$index - 1] ?? null;
        $older = $posts[$index + 1] ?? null;

        // Artikel lain (selain yang sedang dibaca) untuk bagian "Baca juga".
        $related = $posts->where('slug', '!=', $slug)->take(2)->values();

        return view('blog.show', compact('post', 'newer', 'older', 'related'));
    }

    /**
     * Data dummy blog.
     *
     * Controller menyimpan data yang sama di semua bahasa (slug, tanggal, kategori, warna).
     * Judul, ringkasan, dan isi artikel ada di lang/{bahasa}/blog.php.
     */
    public static function posts(): array
    {
        $posts = [
            ['slug' => 'beautiful-mess-proses-desain', 'category' => 'design', 'date' => '2026-05-02', 'read_time' => 4, 'color' => 'yellow', 'variant' => 'dots', 'image' => null],
            ['slug' => 'belakang-panggung-ideafest-sub-2026', 'category' => 'experience', 'date' => '2026-09-05', 'read_time' => 5, 'color' => 'orange', 'variant' => 'lines', 'image' => null],
            ['slug' => 'ai-di-proses-kreatif', 'category' => 'ai', 'date' => '2026-07-14', 'read_time' => 6, 'color' => 'blue', 'variant' => 'bars', 'image' => null],
            ['slug' => 'dari-smk-ke-informatika', 'category' => 'learning', 'date' => '2026-02-20', 'read_time' => 5, 'color' => 'green', 'variant' => 'arrow', 'image' => null],
            ['slug' => 'efek-popcorn-after-effects', 'category' => 'tutorial', 'date' => '2026-04-18', 'read_time' => 4, 'color' => 'red', 'variant' => 'rings', 'image' => null],
        ];

        return array_map(function (array $post) {
            // Teks sesuai bahasa aktif: title, excerpt, content.
            $post = array_merge($post, __("blog.posts.{$post['slug']}"));
            $post['category_label'] = __("blog.categories.{$post['category']}");

            return $post;
        }, $posts);
    }
}
