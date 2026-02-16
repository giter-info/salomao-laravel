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
        Schema::table('units', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('zip_code');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->json('seo_keywords')->nullable()->after('seo_description');
            $table->string('seo_canonical_url')->nullable()->after('seo_keywords');
            $table->string('favicon_ico_path')->nullable()->after('seo_canonical_url');
            $table->string('favicon_16_path')->nullable()->after('favicon_ico_path');
            $table->string('favicon_32_path')->nullable()->after('favicon_16_path');
            $table->string('apple_touch_icon_path')->nullable()->after('favicon_32_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title',
                'seo_description',
                'seo_keywords',
                'seo_canonical_url',
                'favicon_ico_path',
                'favicon_16_path',
                'favicon_32_path',
                'apple_touch_icon_path',
            ]);
        });
    }
};
