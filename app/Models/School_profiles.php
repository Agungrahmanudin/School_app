<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School_profiles extends Model
{
    protected $fillable = [
        'school_name',
        'navbar_name',
        'hero_title',
        'hero_description',
        'hero_image',
        'npsn',
        'address',
        'phone',
        'email',
        'website',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'footer_description',
        'footer_copyright',
        'footer_nav_title',
        'footer_info_title',
        'footer_contact_title',
        'footer_contact_label_address',
        'footer_contact_label_phone',
        'footer_contact_label_email',
        'footer_contact_label_website',
        'footer_nav_home',
        'footer_nav_profile',
        'footer_nav_extracurricular',
        'footer_nav_gallery',
        'footer_nav_news',
        'footer_info_vision',
        'footer_info_teachers',
        'footer_info_students',
        'footer_info_news',
        'footer_contact_menu_1',
        'footer_contact_menu_2',
        'footer_contact_menu_3',
        'footer_contact_menu_4',
        'footer_contact_menu_5',
        'history',
        'vision',
        'mission',
        'principal_name',
        'logo',
        'school_photo',
    ];
}
