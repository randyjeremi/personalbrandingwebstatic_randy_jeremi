<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Halaman Tentang Saya: profil, pendidikan, pengalaman, skills, penghargaan, sertifikasi.
     * Data diambil dari profil LinkedIn Randy Jeremi.
     * Controller hanya menyimpan data tampilan (warna, tag); teksnya ada di lang/{bahasa}/about.php.
     */
    public function index(): View
    {
        $profile = __('about.profile');

        $experiences = self::withText('about.experiences', [
            ['key' => 'alva', 'color' => 'blue', 'tags' => ['Adobe Photoshop', 'Adobe Illustrator', 'Artificial Intelligence', 'Digital Marketing']],
            ['key' => 'ideafest', 'color' => 'orange', 'tags' => ['Project Management', 'Problem Solving', 'Technical Support', 'Teamwork']],
            ['key' => 'delitopia', 'color' => 'yellow', 'tags' => ['Image Design', 'User Experience', 'Online Graphics', 'Logo Design']],
            ['key' => 'yelo', 'color' => 'red', 'tags' => ['Landing Pages', 'Branding', 'Creative Development']],
        ]);

        $education = self::withText('about.education', [
            ['key' => 'ciputra', 'color' => 'green'],
            ['key' => 'purwadhika', 'color' => 'pink'],
            ['key' => 'smk', 'color' => 'blue'],
        ]);

        $skills = collect([
            ['key' => 'design', 'color' => 'yellow', 'items' => ['Branding', 'Visual Identity', 'Logo Design', 'Art Direction', 'Creative Direction', 'Creative Strategy', 'Image Design', 'Online Graphics']],
            ['key' => 'uiux', 'color' => 'orange', 'items' => ['User Interface Design', 'User Experience (UX)', 'Landing Pages', 'Web Design']],
            ['key' => 'tools', 'color' => 'red', 'items' => ['Adobe Photoshop', 'Adobe Illustrator', 'After Effects', 'Figma']],
            ['key' => 'ai', 'color' => 'blue', 'items' => ['Artificial Intelligence', 'Python', 'Machine Learning', 'Digital Marketing']],
            ['key' => 'team', 'color' => 'green', 'items' => ['Project Management', 'Problem Solving', 'Collaborative Problem Solving', 'Teamwork', 'Technical Support']],
        ])->map(fn (array $group) => $group + ['group' => __("about.skill_groups.{$group['key']}")])->all();

        $awards = self::withText('about.awards', [
            ['key' => 'ideafest', 'color' => 'orange', 'rank' => '★'],
            ['key' => 'iofest', 'color' => 'green', 'rank' => '3'],
            ['key' => 'sae', 'color' => 'yellow', 'rank' => '1'],
        ]);

        $certificates = self::withText('about.certificates', [
            ['key' => 'kaggle'],
            ['key' => 'ibm_ai'],
            ['key' => 'ibm_literacy'],
        ]);

        $stats = self::stats();

        return view('about', compact('profile', 'experiences', 'education', 'skills', 'awards', 'certificates', 'stats'));
    }

    /**
     * Angka ringkas yang juga dipakai di Beranda.
     *
     * @return array<int, array{value: int, suffix: string, label: string, color: string}>
     */
    public static function stats(): array
    {
        return [
            ['value' => 2021, 'suffix' => '', 'label' => __('about.stats.since'), 'color' => 'yellow'],
            ['value' => 4, 'suffix' => '', 'label' => __('about.stats.experience'), 'color' => 'orange'],
            ['value' => 3, 'suffix' => '', 'label' => __('about.stats.awards'), 'color' => 'red'],
            ['value' => 3, 'suffix' => '+', 'label' => __('about.stats.certificates'), 'color' => 'blue'],
        ];
    }

    /**
     * Gabungkan data tampilan dengan teks terjemahan berdasarkan "key".
     * Contoh: ['key' => 'alva'] + __('about.experiences.alva').
     */
    private static function withText(string $langKey, array $items): array
    {
        return array_map(
            fn (array $item) => array_merge($item, __("{$langKey}.{$item['key']}")),
            $items
        );
    }
}
