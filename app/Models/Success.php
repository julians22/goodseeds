<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Success extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, HasSlug;

    protected $table = "success";

    public array $translatable = ['title', 'content', 'excerpt'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta',
        'is_published',
        'success_date',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_published' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('id'); // sama kayak Article
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl('/img/fallback/article.png');

        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->useFallbackUrl('/img/fallback/article.png');
    }
}
