<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
    /**
     * Setiap halaman bisa dibuka di semua bahasa dan menampilkan teks bahasa tersebut.
     */
    public function test_pages_render_in_every_locale(): void
    {
        $expectedNav = ['id' => 'Beranda', 'en' => 'Home', 'zh' => '首页'];

        foreach ($expectedNav as $locale => $homeLabel) {
            $this->get(route('locale.switch', $locale))->assertRedirect();

            foreach (['/', '/about', '/portfolio', '/portfolio/linkara-branding', '/blog', '/blog/ai-di-proses-kreatif', '/contact'] as $url) {
                $this->get($url)
                    ->assertOk()
                    ->assertSee('lang="'.$locale.'"', false)
                    ->assertSee($homeLabel);
            }
        }
    }

    public function test_unknown_locale_is_not_found(): void
    {
        $this->get('/lang/fr')->assertNotFound();
    }

    public function test_unknown_project_and_post_return_404(): void
    {
        $this->get('/portfolio/tidak-ada')->assertNotFound();
        $this->get('/blog/tidak-ada')->assertNotFound();
    }
}
