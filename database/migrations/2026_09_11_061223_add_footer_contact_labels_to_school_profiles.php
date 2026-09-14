<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('footer_contact_label_address')->nullable()->after('footer_contact_title');
            $table->string('footer_contact_label_phone')->nullable()->after('footer_contact_label_address');
            $table->string('footer_contact_label_email')->nullable()->after('footer_contact_label_phone');
            $table->string('footer_contact_label_website')->nullable()->after('footer_contact_label_email');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'footer_contact_label_address',
                'footer_contact_label_phone',
                'footer_contact_label_email',
                'footer_contact_label_website',
            ]);
        });
    }
};
