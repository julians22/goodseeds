<?php

use App\Settings\GeneralSetting;

if (!function_exists('appName')) {
    function appName() {
        return config('app.name');
    }
}

/**
 * Navigation Logo
 */
// if (!function_exists('navLogo')) {
//     function navLogo() {
//         return app(GeneralSetting::class)->headerLogo ?? asset('logo.png');
//     }
// }
