<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    /**
     * Halaman Kontak. Email & media sosial diambil dari config/site.php.
     */
    public function index()
    {
        $socials = config('site.socials');

        $details = [
            ['label' => 'Lokasi', 'value' => config('site.location'), 'letter' => 'L', 'color' => 'yellow'],
            ['label' => 'Status', 'value' => config('site.status').' · '.config('site.work_modes'), 'letter' => 'S', 'color' => 'green'],
            ['label' => 'Fokus', 'value' => 'Branding, UI/UX, Motion Graphics', 'letter' => 'F', 'color' => 'orange'],
        ];

        return view('contact', compact('socials', 'details'));
    }
}
