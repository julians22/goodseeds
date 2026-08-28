<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Article extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['title', 'content', 'excerpt'];

    protected $fillable = [
        'title',
        'slug',
        'slug_en',
        'slug_id',
        'content',
        'content_en',
        'excerpt',
        'meta',
        'article_date',
        'is_published',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_published' => 'boolean',
        'content_en' => 'json',
        'content' => 'json'
    ];

    public function getLocalizedSlugAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'id') {
            if (!empty($this->slug_id)) {
                return $this->slug_id;
            }
            return $this->slug;
        }
        return $this->slug_en ?: $this->slug;
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

    protected static function booted()
    {
        static::saving(function ($model) {

            $titleEn = $model->getTranslation('title', 'en', false);
            $titleId = $model->getTranslation('title', 'id', false);

            $model->slug = $titleEn
                ? Str::slug($titleEn)
                : $model->slug;

            $model->slug_en = $titleEn
                ? Str::slug($titleEn)
                : $model->slug_en;

            $model->slug_id = $titleId
                ? Str::slug($titleId)
                : null;
        });
    }
}
