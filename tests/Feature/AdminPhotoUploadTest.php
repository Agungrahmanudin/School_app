<?php

namespace Tests\Feature;

use App\Models\Categories;
use App\Models\News;
use App\Models\School_profiles;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPhotoUploadTest extends TestCase
{
    use RefreshDatabase;

    private function createAdminUser(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }

    public function test_authenticated_admin_can_access_news_index_and_create(): void
    {
        $user = $this->createAdminUser();
        $category = Categories::create([
            'name' => 'Prestasi',
            'slug' => 'prestasi',
            'created_by' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/admin/berita');
        $response->assertStatus(200);
        $response->assertSee('Semua Berita');

        $createResponse = $this->actingAs($user)->get('/admin/berita/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Form Tambah Berita');
    }

    public function test_admin_can_store_news_with_image(): void
    {
        $user = $this->createAdminUser();
        $category = Categories::create([
            'name' => 'Prestasi',
            'slug' => 'prestasi',
            'created_by' => $user->id,
        ]);

        $file = UploadedFile::fake()->image('lomba.jpg', 600, 400);

        $response = $this->actingAs($user)->post('/admin/berita', [
            'title' => 'Juara Olimpiade Matematika',
            'category_id' => $category->id,
            'content' => 'Siswa kami berhasil menjuarai olimpiade matematika nasional.',
            'image' => $file,
        ]);

        $response->assertRedirect('/admin/berita');
        $this->assertDatabaseHas('news', [
            'title' => 'Juara Olimpiade Matematika',
            'category_id' => $category->id,
        ]);

        $news = News::first();
        $this->assertNotEmpty($news->image);
        $this->assertFileExists(public_path($news->image));

        // Cleanup
        if (File::exists(public_path($news->image))) {
            File::delete(public_path($news->image));
        }
    }

    public function test_admin_can_update_school_profile_and_photo(): void
    {
        $user = $this->createAdminUser();
        $profile = School_profiles::create([
            'school_name' => 'SMK Negeri 1',
            'npsn' => '12345678',
            'address' => 'Jl. Merdeka No 1',
            'phone' => '021-123456',
            'email' => 'smk@test.sch.id',
            'website' => 'https://smk.sch.id',
            'history' => 'Sejarah singkat',
            'vision' => 'Visi unggul',
            'mission' => 'Misi unggul',
            'principal_name' => 'Kepala Sekolah M.Pd.',
            'logo' => 'landing-page/assets/images/logo.png',
            'school_photo' => 'landing-page/assets/images/about-right-dec.png',
        ]);

        $filePhoto = UploadedFile::fake()->image('gedung.jpg', 800, 600);

        $response = $this->actingAs($user)->post('/admin/profil-sekolah', [
            'school_name' => 'SMK Negeri 1 Unggul',
            'npsn' => '12345678',
            'principal_name' => 'Kepala Sekolah M.Pd.',
            'email' => 'smk@test.sch.id',
            'phone' => '021-123456',
            'address' => 'Jl. Merdeka No 1',
            'vision' => 'Visi baru',
            'school_photo' => $filePhoto,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('school_profiles', [
            'school_name' => 'SMK Negeri 1 Unggul',
            'vision' => 'Visi baru',
        ]);

        $updatedProfile = School_profiles::first();
        $this->assertStringContainsString('uploads/school/', $updatedProfile->school_photo);
        $this->assertFileExists(public_path($updatedProfile->school_photo));

        // Cleanup
        if (File::exists(public_path($updatedProfile->school_photo))) {
            File::delete(public_path($updatedProfile->school_photo));
        }
    }
}
