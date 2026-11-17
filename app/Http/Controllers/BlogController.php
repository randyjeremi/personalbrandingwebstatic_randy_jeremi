<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    /**
     * Daftar artikel, diurutkan dari yang terbaru.
     */
    public function index()
    {
        $posts = collect(self::posts())->sortByDesc('date')->values();
        $categories = $posts->pluck('category')->unique()->values();

        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Halaman detail artikel ("Baca Selengkapnya").
     */
    public function show(string $slug)
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
     * "content" berisi blok: p (paragraf), h2 (subjudul), list (daftar), quote (kutipan).
     */
    public static function posts(): array
    {
        return [
            [
                'slug' => 'beautiful-mess-proses-desain',
                'title' => 'Beautiful Mess: Kenapa Proses Desain yang Berantakan Itu Sehat',
                'category' => 'Desain',
                'date' => '2026-05-02',
                'read_time' => 4,
                'color' => 'yellow',
                'variant' => 'dots',
                'image' => null,
                'excerpt' => 'Sketsa yang dibuang, layer yang menumpuk, dan revisi tanpa akhir bukan tanda gagal. Itu bukti sebuah ide sedang tumbuh.',
                'content' => [
                    ['type' => 'p', 'text' => 'Kalau kamu membuka file kerja saya, kamu akan melihat puluhan artboard yang tidak terpakai, layer bernama "final-final-fix", dan warna yang berganti tiga kali. Dulu saya malu dengan itu. Sekarang saya menganggapnya bagian penting dari proses.'],
                    ['type' => 'h2', 'text' => 'Berantakan di awal, rapi di akhir'],
                    ['type' => 'p', 'text' => 'Fase eksplorasi memang seharusnya liar. Di fase ini tujuannya bukan membuat yang bagus, tetapi menemukan arah. Semakin banyak kemungkinan yang dicoba, semakin besar peluang menemukan solusi yang tidak terpikirkan di awal.'],
                    ['type' => 'list', 'items' => ['Eksplorasi: buat sebanyak mungkin variasi tanpa menilai.', 'Kurasi: pilih 2–3 arah yang paling kuat.', 'Eksekusi: rapikan grid, tipografi, dan detail.', 'Sistem: dokumentasikan agar bisa dipakai ulang.']],
                    ['type' => 'h2', 'text' => 'Yang perlu dijaga'],
                    ['type' => 'p', 'text' => 'Berantakan boleh, asal tetap punya batas waktu. Saya biasanya memberi jatah waktu khusus untuk eksplorasi, lalu memaksa diri masuk ke tahap kurasi. Tanpa batas itu, proses kreatif bisa berubah menjadi penundaan.'],
                    ['type' => 'quote', 'text' => 'Beautiful mess = growth. Kekacauan yang terarah adalah tanda kita sedang belajar.'],
                ],
            ],
            [
                'slug' => 'belakang-panggung-ideafest-sub-2026',
                'title' => 'Pelajaran dari Belakang Panggung IDEAfest SUB 2026',
                'category' => 'Pengalaman',
                'date' => '2026-09-05',
                'read_time' => 5,
                'color' => 'orange',
                'variant' => 'lines',
                'image' => null,
                'excerpt' => 'Menjadi Technical Crew di event kreatif berskala besar mengajarkan satu hal: detail kecil yang tidak terlihat justru menentukan semuanya.',
                'content' => [
                    ['type' => 'p', 'text' => 'Agustus 2026 saya bergabung sebagai Technical Crew di IDEAfest SUB 2026. Tugasnya terdengar sederhana, yaitu memastikan semua hal teknis berjalan. Kenyataannya, ini adalah salah satu pengalaman belajar paling padat yang pernah saya alami.'],
                    ['type' => 'h2', 'text' => 'Persiapan adalah 80% pekerjaan'],
                    ['type' => 'p', 'text' => 'Sebelum pengunjung datang, kami sudah menyiapkan peralatan, mengecek kesiapan venue, dan memastikan setiap sesi punya kebutuhan teknis yang jelas. Semakin rapi persiapan, semakin tenang saat acara berlangsung.'],
                    ['type' => 'h2', 'text' => 'Koordinasi lintas tim'],
                    ['type' => 'p', 'text' => 'Tim teknis tidak bekerja sendirian. Kami terus berkoordinasi dengan tim event, kreatif, dan produksi agar semuanya sesuai timeline. Komunikasi yang singkat dan jelas ternyata sama pentingnya dengan kemampuan teknis.'],
                    ['type' => 'list', 'items' => ['Pantau kondisi teknis saat sesi live.', 'Respons cepat ketika ada kendala agar acara tidak terganggu.', 'Catat masalah yang muncul untuk evaluasi berikutnya.']],
                    ['type' => 'p', 'text' => 'Di akhir acara, saya mendapat penghargaan Best Technical Crew. Bagi saya, penghargaan itu adalah pengingat bahwa pekerjaan di balik layar juga punya dampak besar.'],
                ],
            ],
            [
                'slug' => 'ai-di-proses-kreatif',
                'title' => 'Memakai AI di Proses Kreatif Tanpa Kehilangan Identitas Brand',
                'category' => 'AI',
                'date' => '2026-07-14',
                'read_time' => 6,
                'color' => 'blue',
                'variant' => 'bars',
                'image' => null,
                'excerpt' => 'AI bisa mempercepat produksi visual, tapi brand tetap butuh arah. Begini cara saya membagi peran antara mesin dan desainer.',
                'content' => [
                    ['type' => 'p', 'text' => 'Sejak bekerja dengan ALVA Technology Resolution, saya banyak bereksperimen memasukkan AI ke dalam alur kerja desain. Hasilnya menarik: produksi jauh lebih cepat, tetapi tantangan baru muncul, yaitu menjaga konsistensi brand.'],
                    ['type' => 'h2', 'text' => 'AI untuk eksplorasi, manusia untuk keputusan'],
                    ['type' => 'p', 'text' => 'Saya memakai AI di tahap awal: mencari variasi ide, komposisi, dan suasana visual. Begitu arah sudah ditemukan, keputusan tentang tipografi, warna, dan hierarki tetap saya kerjakan secara manual.'],
                    ['type' => 'h2', 'text' => 'Buat pagar pembatas'],
                    ['type' => 'list', 'items' => ['Siapkan brand guideline sederhana: warna, font, gaya foto.', 'Simpan prompt yang berhasil agar hasil konsisten.', 'Selalu edit ulang output AI, jangan dipakai mentah.', 'Periksa hak cipta dan kesesuaian konten.']],
                    ['type' => 'quote', 'text' => 'AI mempercepat tangan, bukan menggantikan mata.'],
                    ['type' => 'p', 'text' => 'Dengan pembagian peran seperti ini, AI menjadi asisten produksi yang kuat, sementara identitas brand tetap terjaga.'],
                ],
            ],
            [
                'slug' => 'dari-smk-ke-informatika',
                'title' => 'Dari SMK Telkom ke Informatika: Catatan Belajar UI/UX',
                'category' => 'Belajar',
                'date' => '2026-02-20',
                'read_time' => 5,
                'color' => 'green',
                'variant' => 'arrow',
                'image' => null,
                'excerpt' => 'Perjalanan dari Rekayasa Perangkat Lunak, bootcamp UI/UX di Purwadhika, sampai kuliah Informatika, dan apa yang saya pelajari di setiap stasiunnya.',
                'content' => [
                    ['type' => 'p', 'text' => 'Saya memulai dari jurusan Rekayasa Perangkat Lunak di SMK Telkom 1 Medan. Di sana saya belajar logika pemrograman, sekaligus menemukan bahwa saya lebih bersemangat ketika mengerjakan sisi tampilan.'],
                    ['type' => 'h2', 'text' => 'Stasiun 1: kompetisi'],
                    ['type' => 'p', 'text' => 'Kompetisi menjadi tempat latihan terbaik. Juara 1 web design tingkat provinsi Sumatera Utara dan Juara 3 web development di I/O Fest 2023 mengajarkan saya bekerja dengan tenggat waktu dan dalam tim.'],
                    ['type' => 'h2', 'text' => 'Stasiun 2: Purwadhika'],
                    ['type' => 'p', 'text' => 'Program Job Connector UI/UX di Purwadhika membuka mata saya soal riset pengguna, wireframe, dan cara mempresentasikan desain kepada orang lain, bukan hanya membuatnya terlihat bagus.'],
                    ['type' => 'h2', 'text' => 'Stasiun 3: Informatika'],
                    ['type' => 'p', 'text' => 'Sekarang di Universitas Ciputra Surabaya, saya kembali memperdalam sisi teknis. Kombinasi desain dan kode membuat saya bisa berbicara dengan desainer maupun developer.'],
                    ['type' => 'list', 'items' => ['Mulai dari proyek kecil, tapi selesaikan.', 'Ikut kompetisi untuk melatih mental dan kecepatan.', 'Dokumentasikan proses, bukan hanya hasil akhir.']],
                ],
            ],
            [
                'slug' => 'efek-popcorn-after-effects',
                'title' => 'Tutorial Singkat: Efek "Pop-Corn" di After Effects',
                'category' => 'Tutorial',
                'date' => '2026-04-18',
                'read_time' => 4,
                'color' => 'red',
                'variant' => 'rings',
                'image' => null,
                'excerpt' => 'Elemen yang "meletup" satu per satu dengan sedikit pantulan. Efek sederhana yang langsung membuat motion terasa hidup.',
                'content' => [
                    ['type' => 'p', 'text' => 'Efek pop-corn adalah animasi di mana banyak elemen kecil muncul bergantian seperti jagung yang meletup. Kuncinya ada di scale, timing yang acak, dan sedikit overshoot.'],
                    ['type' => 'h2', 'text' => 'Langkah dasar'],
                    ['type' => 'list', 'items' => ['Buat elemen (lingkaran, ikon, atau huruf) di layer terpisah.', 'Animasikan Scale dari 0% ke 110% lalu turun ke 100%.', 'Gunakan Easy Ease, lalu atur graph editor agar awalnya cepat.', 'Geser keyframe setiap layer secara acak beberapa frame.']],
                    ['type' => 'h2', 'text' => 'Biar lebih natural'],
                    ['type' => 'p', 'text' => 'Tambahkan sedikit rotasi dan posisi yang ikut bergerak saat elemen muncul. Variasi kecil inilah yang membuat animasi terasa organik dan tidak kaku.'],
                    ['type' => 'quote', 'text' => 'Overshoot sedikit saja sudah cukup. Terlalu banyak membuat gerakan terasa murahan.'],
                    ['type' => 'p', 'text' => 'Efek ini juga saya terapkan di website ini: lihat bagaimana lencana bulat berwarna muncul dengan sedikit pantulan.'],
                ],
            ],
        ];
    }
}
