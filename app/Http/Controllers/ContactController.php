<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Halaman Kontak. Email & media sosial diambil dari config/site.php.
     */
    public function index(): View
    {
        $socials = config('site.socials');

        $details = [
            ['label' => __('contact.details.location'), 'value' => __('site.location'), 'letter' => 'L', 'color' => 'yellow'],
            ['label' => __('contact.details.status'), 'value' => __('site.status').' · '.__('site.work_modes'), 'letter' => 'S', 'color' => 'green'],
            ['label' => __('contact.details.focus'), 'value' => __('contact.focus_value'), 'letter' => 'F', 'color' => 'orange'],
        ];

        return view('contact', compact('socials', 'details'));
    }
}
