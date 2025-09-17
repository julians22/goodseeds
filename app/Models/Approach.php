<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approach extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    protected $appends = ['icon_url'];

    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/approaches/' . $this->icon) : null;
    }
}
