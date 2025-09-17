<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'link',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')->singleFile();
    }

    public function getIconUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('icon');
    }
}
