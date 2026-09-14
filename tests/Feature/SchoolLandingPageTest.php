<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolLandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Beranda');
        $response->assertSee('Profil Sekolah');
        $response->assertSee('Ekstrakurikuler');
        $response->assertSee('Galeri');
    }

    public function test_profile_page_contains_school_table(): void
    {
        $response = $this->get('/profil-sekolah');
        $response->assertStatus(200);
        $response->assertSee('Tabel Informasi Profil Sekolah');
        $response->assertSee('Nomor Pokok Sekolah Nasional');
    }

    public function test_extracurriculars_page_can_be_rendered(): void
    {
        $response = $this->get('/ekstrakurikuler');
        $response->assertStatus(200);
        $response->assertSee('Ekstrakurikuler');
    }

    public function test_gallery_page_can_be_rendered(): void
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri');
    }

    public function test_news_page_can_be_rendered(): void
    {
        $response = $this->get('/berita-kegiatan');
        $response->assertStatus(200);
        $response->assertSee('Berita & Kegiatan');
    }
}
