<?php

namespace App\Http\Controllers;

use App\Models\Approach;
use App\Models\Banner;
use App\Models\Provide;
use App\Models\Service;
use App\Models\Team;
use App\Settings\GeneralSetting;
use App\Settings\SectionSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(GeneralSetting $generalSetting, SectionSetting $sectionSetting)
    {
        // dd($sectionSetting);
        $banners = Banner::take(5)->get();

        $primaryText = $banners->where('primary_text', true)->first();

        $teams = Team::take(5)->get();

        $services = Service::take(4)->get();

        $provides = Provide::take(4)->get();

        $approaches = Approach::take(4)->get();

        $socialIcons = $generalSetting->socialMediaLinks;

        // Attach icon from storage
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

        return view('welcome', compact('banners', 'services', 'teams', 'settings', 'primaryText', 'sectionSetting', 'provides', 'approaches'));
    }
}
