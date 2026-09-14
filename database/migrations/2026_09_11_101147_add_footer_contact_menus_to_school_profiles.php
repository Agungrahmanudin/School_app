<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('footer_contact_menu_1')->nullable()->after('footer_contact_title');
            $table->string('footer_contact_menu_2')->nullable()->after('footer_contact_menu_1');
            $table->string('footer_contact_menu_3')->nullable()->after('footer_contact_menu_2');
            $table->string('footer_contact_menu_4')->nullable()->after('footer_contact_menu_3');
            $table->string('footer_contact_menu_5')->nullable()->after('footer_contact_menu_4');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'footer_contact_menu_1',
                'footer_contact_menu_2',
                'footer_contact_menu_3',
                'footer_contact_menu_4',
                'footer_contact_menu_5',
            ]);
        });
    }
};
