<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Settings\GeneralSetting;
use App\Filament\Note\SpecialNoteBlock;
use FilamentTiptapEditor\TiptapEditor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TiptapEditor::configureUsing(function (TiptapEditor $component) {
            $component->blocks([
                SpecialNoteBlock::class,
            ]);
        });
        View::composer('*', function ($view) {
        $generalSetting = app(GeneralSetting::class);

        $socialIcons = $generalSetting->socialMediaLinks;
        foreach ($socialIcons as $key => $socialIcon) {
            $socialIcons[$key]['icon'] = asset('img/icons/' . $socialIcon['role'] . '.png');
        }

        $whatsappMessage = urlencode($generalSetting->whatsappContactMessage);
        $whatsappLink = "https://api.whatsapp.com/send?phone=62{$generalSetting->whatsappContactNumber}&text={$whatsappMessage}";

        $settings = [
            'headerLogo' => $generalSetting->headerLogo ? asset('storage/' . $generalSetting->headerLogo) : asset('logo.png'),
            'footerLogo' => $generalSetting->footerLogo ? asset('storage/' . $generalSetting->footerLogo) : asset('logo-white.png'),
            'siteAddress' => $generalSetting->siteAddress ? nl2br($generalSetting->siteAddress) : '',
            'socialMediaLinks' => $socialIcons,
            'siteTitle' => $generalSetting->siteTitle,
            'whatsappLink' => $whatsappLink,
            'whatsappPopupGreetingMessage' => $generalSetting->whatsappPopupGreetingMessage,
        ];

        $view->with('settings', $settings);
    });
    }
}
