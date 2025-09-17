<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/services/' . $this->image)
            : null;
    }

}
