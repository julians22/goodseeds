<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'socials',
        'certificate',
    ];

    protected $casts = [
        'socials' => 'array',
        'certificate' => 'array',
        'description' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'socials_array', 'certificate_array'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/teams/' . $this->image)
            : null;
    }

    public function getCertificateArrayAttribute()
    {
        if (is_array($this->certificate)) {
            return $this->certificate;
        }

        return json_decode($this->certificate, true);
    }

    // SocialsArray accessors
    public function getSocialsArrayAttribute()
    {
        if (is_array($this->socials)) {
            return $this->socials;
        }

        return json_decode($this->socials, true);
    }
}
