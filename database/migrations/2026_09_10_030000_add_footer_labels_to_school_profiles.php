<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('footer_nav_title')->nullable();
            $table->string('footer_info_title')->nullable();
            $table->string('footer_contact_title')->nullable();
            $table->string('footer_nav_home')->nullable();
            $table->string('footer_nav_profile')->nullable();
            $table->string('footer_nav_extracurricular')->nullable();
            $table->string('footer_nav_gallery')->nullable();
            $table->string('footer_nav_news')->nullable();
            $table->string('footer_info_vision')->nullable();
            $table->string('footer_info_teachers')->nullable();
            $table->string('footer_info_students')->nullable();
            $table->string('footer_info_news')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'footer_nav_title',
                'footer_info_title',
                'footer_contact_title',
                'footer_nav_home',
                'footer_nav_profile',
                'footer_nav_extracurricular',
                'footer_nav_gallery',
                'footer_nav_news',
                'footer_info_vision',
                'footer_info_teachers',
                'footer_info_students',
                'footer_info_news',
            ]);
        });
    }
};