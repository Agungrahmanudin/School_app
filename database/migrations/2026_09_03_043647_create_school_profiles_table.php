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
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('npsn');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->text('history');
            $table->text('vision');
            $table->text('mission');
            $table->string('principal_name');
            $table->string('logo');
            $table->string('school_photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
