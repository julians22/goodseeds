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

    // Notification Email
    public array $notificationRecipients = [];

    // Whatsapp ContactNumber
    public string $whatsappContactNumber = '';

    // Whatsapp ContactMessage
    public string $whatsappContactMessage = '';

    // Whatsapp Popup Greeting Message
    public string $whatsappPopupGreetingMessage = '';

    public static function group(): string
    {
        return 'general';
    }
}
