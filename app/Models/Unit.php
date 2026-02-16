<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'summary',
        'description',
        'hero_title',
        'hero_subtitle',
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
        'address_line',
        'city',
        'state',
        'zip_code',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_canonical_url',
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
        'favicon_ico_path',
        'favicon_16_path',
        'favicon_32_path',
        'apple_touch_icon_path',
        'theme',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'seo_keywords' => 'array',
        'theme' => 'array',
        'is_active' => 'boolean',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function diseases(): HasMany
    {
        return $this->hasMany(Disease::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function mediaAssets(): HasMany
    {
        return $this->hasMany(MediaAsset::class);
    }
}
