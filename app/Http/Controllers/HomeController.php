<?php

namespace App\Http\Controllers;

use App\Models\Approach;
use App\Models\Article;
use App\Models\ArticlesPages;
use App\Models\Banner;
use App\Models\HomePages;
use App\Models\HomeSupports;
use App\Models\Provide;
use App\Models\Service;
use App\Models\ServicesPages;
use App\Models\Success;
use App\Models\SuccessPages;
use App\Models\Team;
use App\Settings\GeneralSetting;
use App\Settings\SectionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index(GeneralSetting $generalSetting, SectionSetting $sectionSetting)
    {
        $banners = Banner::take(5)->get();
        $primaryText = $banners->where('primary_text', true)->first();
        $teams = Team::take(5)->get();
        $provides = Provide::take(4)->get();
        $approaches = Approach::take(4)->get();
        $meta = HomePages::first();

        $clients = [];
        for ($i = 1; $i <= 6; $i++) {
            $clients[] = url("img/clients/logo-{$i}.png");
        }
        $loopingClients = array_merge($clients, $clients);

        $experts = [
            [
                'name' => 'Deddy Sudja',
                'image' => 'teams/expert-people.png',
            ],
            [
                'name' => 'Meilinda Sudja',
                'image' => 'teams/expert-people.png',
            ],
        ];
        
        if ($teams->isEmpty()) {
            $teams = collect($experts)->map(function ($item) {
                return (object) [
                    'name' => $item['name'],
                    'image_url' => asset($item['image']),
                ];
            });
        } else {
            $teams->transform(function ($team) {
                $team->image_url = $team->image_url; 
                return $team;
            });
        }

        $services = Service::take(3)->get();
        $services->transform(function ($service) {
            $decoded = $service->description;
            if (!is_array($decoded)) {
                $decoded = json_decode((string) $service->description, true) ?? [];
            }

            foreach ($decoded as $lang => $content) {
                $content = preg_replace('/<p\b[^>]*>.*?<\/p>/si', '', $content);

                $content = str_replace('&nbsp;', ' ', $content);
                $content = preg_replace('/\s{2,}/', ' ', $content);

                $decoded[$lang] = trim($content);
            }

            $service->description = $decoded;
            return $service;
        });

        return view('welcome', compact('banners', 'services', 'teams', 'primaryText', 'sectionSetting', 'provides', 'approaches', 'loopingClients', 'experts', 'meta'));
    }

    public function article(GeneralSetting $generalSetting, SectionSetting $sectionSetting)
    {
        $meta = ArticlesPages::first();
        $articles = Article::with('media')
            ->where('is_published', true)
            ->orderBy('article_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('article', compact('articles','sectionSetting', 'meta'));
    }

    public function showArticle(GeneralSetting $generalSetting, SectionSetting $sectionSetting, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $previous = Article::where('slug', '<', $slug)->orderBy('id', 'desc')->first();
        $next = Article::where('slug', '>', $slug)->orderBy('id', 'asc')->first();

        return view(
            'article_detail', compact('sectionSetting', 'article'), ['previous' => $previous, 'next' => $next]
        );
    }

    public function indexWhatWeDo(GeneralSetting $generalSetting, SectionSetting $sectionSetting)
    {
        $meta = ServicesPages::first();
        $teams = Team::take(5)->get();
        $services = Service::all();
        $approaches = Approach::take(4)->get();

        if ($services->isEmpty()) {
            $fallback = collect(trans('wordings.homeServices_data'));
            $services = $fallback->map(fn ($item) => (object)[
                'image_url' => asset($item['services_img'] . '.png'),
                'name'        => $item['services_title'],
                'description' => [
                    app()->getLocale() => $item['services_content'],
                ],
            ]);
        }

        $experts = [
            [
                'name' => 'Deddy Sudja',
                'certificate' => [
                    'img/certificate/serti-1.png',
                    'img/certificate/serti-2.png',
                    'img/certificate/serti-3.png',
                ],
                'content' => [
                    'en' => "With 25 years of experience in IT, manufacturing, distribution, and retail, he excels in building new businesses, scaling up enterprises and organization & culture development. At CTI Group and its 12 subsidiaries, he has nurtured talent and driven impactful change. He holds an MBA from SBM ITB and an Executive Education Certificate from INSEAD.",
                    'id' => "Dengan 25 tahun pengalaman di bidang TI, manufaktur, distribusi, dan ritel, ia ahli dalam membangun bisnis baru, mengembangkan perusahaan, serta pengembangan organisasi dan budaya. Di CTI Group dan 12 anak perusahaannya, ia telah membina talenta dan mendorong perubahan yang berdampak. Ia meraih gelar MBA dari SBM ITB dan Sertifikat Executive Education dari INSEAD.",
                ],
                'image' => 'teams/expert-people.png',
            ],
            [
                'name' => 'Meilinda Sudja',
                'certificate' => [],
                'content' => [
                    'en' => "An experienced HR practitioner with 17 years in recruitment and talent management. She placed over 35 C-level executives in executive search, then served as Corporate Recruitment Manager and HRBP Senior Manager in the hospital industry. For the past four years, she has been an independent HR consultant, helping clients manage HR operations and find top talent. She holds a Bachelor's in Mass Communication from the University of Indonesia",
                    'id' => "Praktisi HR berpengalaman dengan 17 tahun di bidang rekrutmen dan manajemen talenta. Ia telah menempatkan lebih dari 35 eksekutif tingkat C dalam executive search, kemudian menjabat sebagai Corporate Recruitment Manager dan HRBP Senior Manager di industri rumah sakit. Selama empat tahun terakhir, ia menjadi konsultan HR independen, membantu klien dalam mengelola operasional HR dan menemukan talenta terbaik. Ia meraih gelar Sarjana Ilmu Komunikasi dari Universitas Indonesia.",
                ],
                'image' => 'teams/expert-people.png',
            ],
        ];

        $normalizeCertificates = function ($certs) {
            return collect($certs ?? [])->map(function ($c) {
                if (is_array($c)) {
                    $path = $c['file'] ?? $c['path'] ?? ($c[0] ?? null);
                } elseif (is_object($c)) {
                    $path = $c->file ?? $c->path ?? null;
                } else {
                    $path = $c;
                }
                $path = is_string($path) ? trim($path) : null;

                return $path ? ['file' => $path] : null;
            })->filter()->values()->all();
        };

        if ($teams->isEmpty()) {
            $teams = collect($experts)->map(function ($expert) use ($normalizeCertificates) {
                return (object)[
                    'name'        => $expert['name'],
                    'certificate' => $normalizeCertificates($expert['certificate']),
                    'description' => $expert['content'],
                    'image_url'   => asset($expert['image']),
                    'socials_array' => [],
                ];
            });
        } else {
            $teams = $teams->map(function ($team, $i) use ($experts, $normalizeCertificates) {
                $expert = $experts[$i] ?? null;

                return (object)[
                    'name' => $team->name ?? ($expert['name'] ?? 'Unknown'),

                    'certificate' => !empty($team->certificate)
                        ? $normalizeCertificates($team->certificate)
                        : $normalizeCertificates($expert['certificate'] ?? []),

                    'description' => is_array($team->description) && !empty($team->description)
                        ? $team->description
                        : ($expert['content'] ?? []),

                    'image_url' => $team->image_url
                        ?? asset($expert['image'] ?? 'img/default.png'),

                    'socials_array' => $team->socials_array ?? [],
                ];
            });
        }

        return view('what-we-do', compact('teams', 'services', 'approaches', 'experts', 'meta', 'sectionSetting'));
    }

    public function indexSuccessStory(GeneralSetting $generalSetting, SectionSetting $sectionSetting)
    {
        $meta = SuccessPages::first();
        $SuccessStories = Success::with('media')
            ->where('is_published', true)
            ->orderBy('success_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('success-story', compact('SuccessStories', 'meta', 'sectionSetting'));
    }

    public function showSuccessStory(GeneralSetting $generalSetting, SectionSetting $sectionSetting, $slug)
    {
        // // App::setLocale("en");
        // $locale = app()->getLocale();
        // // dump($locale); 
        // $id = last(explode('-', $slug));

        $success = Success::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // if ($success->slug[$locale]."-".$success->id != $slug) {
        //     return redirect()->to(route('success-story-detail', ['slug' => $success->slug[$locale]."-".$success->id]));
        // }

        // if slug is not in current locale, set the slug
        $previous = Success::where('is_published', true)
            ->where(function ($query) use ($success) {
                if ($success->success_date) {
                    $query->where('success_date', '>', $success->success_date)
                        ->orWhere(function ($q) use ($success) {
                            $q->where('success_date', $success->success_date)
                                ->where('id', '>', $success->id);
                        });
                } else {
                    $query->where('id', '>', $success->id);
                }
            })
            ->orderBy('success_date', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        $next = Success::where('is_published', true)
            ->where(function ($query) use ($success) {
                if ($success->success_date) {
                    $query->where('success_date', '<', $success->success_date)
                        ->orWhere(function ($q) use ($success) {
                            $q->where('success_date', $success->success_date)
                                ->where('id', '<', $success->id);
                        });
                } else {
                    $query->where('id', '<', $success->id);
                }
            })
            ->orderBy('success_date', 'desc')
            ->orderBy('id', 'desc')
            ->first();


        return view(
            'success-story-detail', compact('sectionSetting', 'success'), ['previous' => $previous, 'next' => $next]
        );
    }
}
