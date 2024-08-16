<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'titles',
    ];

    protected $casts = [
        'titles' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'titles_array'];

    public function getImageUrlAttribute()
    {
        return asset('storage/banners/' . $this->image);
    }

    // TitleArray accessors
    public function getTitlesArrayAttribute()
    {
        if (is_array($this->titles)) {
            return $this->titles;
        }

        return json_decode($this->titles, true);
    }
}
