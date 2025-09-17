<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SectionSetting extends Settings
{

    // About Content
    public ?array $aboutTitle = null;
    public ?array $aboutDescription = null;

    // About Supports
    public ?array $aboutSupportsTitle = null;
    public ?array $aboutSupportsContent = null;

    // Services Content
    public ?array $servicesTitle = null;
    public ?array $servicesNewTitle = null;
    public ?array $servicesDescription = null;

    // Portfolio Content
    public null|string $provideTitle = '';

    // Diagram Content
    public null|string $diagramImage = '';
    public null|string $diagramImageMobile = '';

    // Approach Content
    public ?array $approachTitle = null;
    public ?array $approachDescription = null;

    // Team Content
    public ?array $teamTitle = null;
    public ?array $teamDescription = null;

    // Message Content
    public ?array $messages = null;

    //Success Story Content
    public ?array $successStoryTitle = null;
    public ?array $successStoryDescription = null;

    //Articles Content
    public ?array $articleTitle = null;
    public ?array $articleDescription = null;

    public static function group(): string
    {
        return 'content';
    }
}
