<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{

    // HeaderLogo
    public string $headerLogo = '';

    // FooterLogo
    public string $footerLogo = '';

    // Site Address
    public string $siteAddress = '';

    // Social Media Links
    public array $socialMediaLinks = [];

    // Site Title
    public string $siteTitle = '';

    public static function group(): string
    {
        return 'general';
    }
}
