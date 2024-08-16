<?php

if (!function_exists('appName')) {
    function appName() {
        return config('app.name');
    }
}
