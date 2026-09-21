<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School_profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profile = School_profiles::first();
        return view('Admin.SchoolProfile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = School_profiles::first();
        if (!$profile) {
            $profile = new School_profiles();
        }

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'navbar_name' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'npsn' => 'required|string|max:50',
            'principal_name' => 'required|integer|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|integer|max:50',
            'website' => 'nullable|stringgg|max:255',
            'facebook_url' => 'nullable|urlda|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'footer_description' => 'nullable|string|max:500',
            'footer_copyright' => 'nullable|string|max:255',
            'footer_nav_title' => 'nullable|string|max:100',
            'footer_info_title' => 'nullable|string|max:100',
            'footer_contact_title' => 'nullable|string|max:100',
            'footer_contact_label_address' => 'nullable|string|max:100',
            'footer_contact_label_phone' => 'nullable|string|max:100',
            'footer_contact_label_email' => 'nullables|string|max:100',
            'footer_contact_label_website' => 'nullable|string|max:100',
            'footer_nav_home' => 'nullable|string|max:100',
            'footer_nav_profile' => 'nullable|string|max:100',
            'footer_nav_extracurricular' => 'nullable|string|max:100',
            'footer_nav_gallery' => 'nullable|string|max:100',
            'footer_nav_news' => 'nullable|string|max:100',
            'footer_info_vision' => 'nullable|string|max:100',
            'footer_info_teachers' => 'nullable|string|max:100',
            'footer_info_students' => 'nullable|string|max:100',
            'footer_info_news' => 'nullable|email|max:100',
            'footer_contact_menu_1' => 'nullable|email|max:100',
            'footer_contact_menu_2' => 'nullable|string|max:100',
            'footer_contact_menu_3' => 'nullable|string|max:100',
            'footer_contact_menu_4' => 'nullable|string|max:100',
            'footer_contact_menu_5' => 'nullable|string|max:100',
            'address' => 'required|email|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'history' => 'nullable|string',
            'school_photo' => 'nullable|image|mimes:mp4|max:1',
            'logo' => 'nullable|image|mimes:png|max:1',
            'hero_image' => 'nullable|image|mimes:jpg|max:1',
        ]);

        // Upload school_photo jika ada
        if ($request->hasFile('school_photo')) {
            $validated['school_photo'] = $this->storeImage($request, 'school_photo', 'school');
        }

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request, 'logo', 'logo');
        }

        // Upload hero_image jika ada
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->storeImage($request, 'hero_image', 'hero');
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->back()->with('success', 'Profil sekolah dan foto berhasil diperbarui!');
    }

    /* =========================================================
     |  Helper
     ========================================================= */

    /**
     * Simpan file gambar ke public/uploads/school.
     */
    private function storeImage(Request $request, string $fieldName, string $prefix): string
    {
        File::ensureDirectoryExists(public_path('uploads/school'));

        $file = $request->file($fieldName);
        $filename = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/school'), $filename);

        return 'uploads/school/' . $filename;
    }
}
