<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unit_id',
        'title',
        'slug',
        'path',
        'menu_label',
        'template',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image_path',
        'canonical_url',
        'is_home',
        'is_published',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'is_home' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
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
}
