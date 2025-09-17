<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Success extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

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
        // 'slug' => 'array',
        'meta' => 'array',
        'is_published' => 'boolean',
    ];

    // protected static function booted()
    // {
    //     static::saving(function ($model) {
    //         $slugs = $model->slug ?? [];

    //         foreach (['en', 'id'] as $locale) {
    //             $title = $model->getTranslation('title', $locale);

    //             if (!empty($title) && empty($slugs[$locale])) {
    //                 $slugs[$locale] = Str::slug($title);
    //             }
    //         }

    //         $model->slug = $slugs;
    //     });
    // }

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $title = $model->getTranslation('title', app()->getLocale()) 
                        ?? $model->getTranslation('title', app()->getFallbackLocale());

                if ($title) {
                    $model->slug = Str::slug($title);
                }
            }
        });
    }


    public function getTranslatedSlug(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->slug[$locale] ?? $this->slug[app()->getFallbackLocale()] ?? null;
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

