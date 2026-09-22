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
            'principal_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'website' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'history' => 'nullable|string',
            'school_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Upload school_photo jika ada
        if ($request->hasFile('school_photo')) {
            $validated['school_photo'] = $this->storeImage($request, 'school_photo', 'school');
        }

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request, 'logo', 'logo');
            @copy(public_path($validated['logo']), public_path('favicon.ico'));
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