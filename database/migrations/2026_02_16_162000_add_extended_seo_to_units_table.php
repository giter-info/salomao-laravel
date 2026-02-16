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
            $table->string('seo_robots')->nullable()->after('seo_canonical_url');
            $table->string('seo_author')->nullable()->after('seo_robots');
            $table->string('seo_locale', 10)->nullable()->after('seo_author');

            $table->string('seo_og_type', 30)->nullable()->after('seo_locale');
            $table->string('seo_og_title')->nullable()->after('seo_og_type');
            $table->text('seo_og_description')->nullable()->after('seo_og_title');
            $table->string('seo_og_image_path')->nullable()->after('seo_og_description');

            $table->string('seo_twitter_card', 30)->nullable()->after('seo_og_image_path');
            $table->string('seo_twitter_site')->nullable()->after('seo_twitter_card');
            $table->string('seo_twitter_creator')->nullable()->after('seo_twitter_site');
            $table->string('seo_twitter_title')->nullable()->after('seo_twitter_creator');
            $table->text('seo_twitter_description')->nullable()->after('seo_twitter_title');
            $table->string('seo_twitter_image_path')->nullable()->after('seo_twitter_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn([
                'seo_robots',
                'seo_author',
                'seo_locale',
                'seo_og_type',
                'seo_og_title',
                'seo_og_description',
                'seo_og_image_path',
                'seo_twitter_card',
                'seo_twitter_site',
                'seo_twitter_creator',
                'seo_twitter_title',
                'seo_twitter_description',
                'seo_twitter_image_path',
            ]);
        });
    }
};
