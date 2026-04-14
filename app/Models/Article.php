<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMedia, HasRichContent
{
    use HasFactory, HasTranslations, HasSlug, InteractsWithMedia, InteractsWithRichContent;

    public array $translatable = ['title', 'content', 'excerpt'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta',
        'article_date',
        'is_published',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_published' => 'boolean',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('id');
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

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('content-file-attachments'),
            );
    }
}
