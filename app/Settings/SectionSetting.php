<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SectionSetting extends Settings
{

    // About Content
    public null|string $aboutTitle = '';
    public null|string $aboutDescription = '';

    // Services Content
    public null|string $servicesTitle = '';

    // Portfolio Content
    public null|string $provideTitle = '';

    // Diagram Content
    public null|string $diagramImage = '';
    public null|string $diagramImageMobile = '';

    // Approach Content
    public null|string $approachTitle = '';
    public null|string $approachDescription = '';


    public static function group(): string
    {
        return 'content';
    }
}
