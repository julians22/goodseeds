@extends('layouts.app')

@section('title', $meta->meta_title[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('description', $meta->meta_description[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('keywords', implode(',', $meta->meta_keywords[app()->getLocale()] ?? []))

@section('content')

    <section id="home">
        <div id="carouselHome" class="carousel slide" data-bs-touch="true" data-bs-ride="true">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                    @php
                        $mediaPath = $banner->image_url ?? (isset($banner->image) ? asset('storage/' . $banner->image) : null);
                        $ext = strtolower(pathinfo(parse_url($mediaPath, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));
                        $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);
                    @endphp

                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" @if(!$isVideo) data-bs-interval="3000" @endif>
                        @if ($isVideo)
                            <video
                                src="{{ $mediaPath }}"
                                class="d-block w-100 banner-video"
                                autoplay
                                muted
                                playsinline
                                webkit-playsinline
                                preload="metadata"
                                controlsList="nodownload nofullscreen noremoteplayback"
                                style="pointer-events: none; user-select: none;"
                            ></video>
                        @else
                            <img src="{{ $mediaPath }}" class="d-block w-100 banner-image"/>
                        @endif
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="placeholder" class="pt-5">
        <div class="container">
            <div class="row align-items-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="col-xxl-4 col-xl-5 col-lg-5" style="padding-bottom:2rem;">
                <div class="text-banner fw-bold">
                    @foreach (preg_split('/\r\n|\r|\n/', $sectionSetting->aboutTitle[app()->getLocale()] ?? __('wordings.homeAbout_title')) ?? '' as $i => $line)
                    <span class="line {{ $i >= 2 ? 'green' : '' }}">
                        {{ $line }}
                    </span>
                    @endforeach
                </div>
                </div>
                <div class="col-xxl-8 col-xl-7 col-lg-7">
                <div class="text-left lead fw-md-medium editor-body">
                    <h3>{!! $sectionSetting->aboutDescription[app()->getLocale()] ?? __('wordings.homeAbout_text') ?? '' !!}</h3>
                </div>
                </div>
            </div>
            </div>
        <div class="container mb-5">
            <div class="row" style="padding: 2rem 0;">
                <div class="col-md-12 mb-6">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title">
                        <h2 class="d-inline text-green-light fw-bolder display-5">
                            {{ $sectionSetting->aboutSupportsTitle[app()->getLocale()] ?? __('wordings.homeAboutSupport_title') ?? '' }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @php
                    $supports = $sectionSetting->aboutSupportsContent ?? __('wordings.homeAboutSupport_data') ?? [];
                @endphp

                @foreach($supports as $item)
                    <div class="col-12 col-sm-6 col-md-3 mb-4 mt-8 row gx-md-2">
                        <div class="homesupport__card text-center">
                            <div class="homesupport__icon" data-aos="fade-right" data-aos-duration="780">
                                <img 
                                    src="{{ isset($item['icon']) ? asset('storage/' . $item['icon']) : asset($item['image']) }}" 
                                    alt="icon" 
                                    class="img-fluid">
                            </div>
                            <h4 class="homesupport__text mt-3" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">
                                {!! $item['aboutSupportsDescription'][app()->getLocale()] ?? $item['shortDesc'] !!}
                            </h4>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section id="what-we-do" style="background: #f1f2f2;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                        <h1 class="page__title">
                            {!! nl2br($sectionSetting->servicesTitle[app()->getLocale()] ?? __('wordings.homeServices_title') ?? 'What We Do') !!}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="mt-2 mt-lg-5 row gx-0 gy-5 gx-md-5">
                @php
                    $servicesList = $services->isNotEmpty() ? $services : collect(__('wordings.homeServices_data'));
                @endphp

                @foreach ($servicesList as $item)
                    <div class="col-md-4">
                        @if(isset($item->id))
                            <a href="{{ route('what-we-do') }}?service={{ $item->id }}" class="text-decoration-none text-reset">
                                <div class="card-whatwedo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                    <div class="card-header">
                                        <img src="{{ $item->image_url }}" alt="" class="w-100">
                                    </div>
                                    <div class="card-footer">
                                        <h2 class="text-blue-400 fw-bold">{{ $item->name }}</h2>
                                        <article class="fw-medium lead">
                                            {!! $item->description[app()->getLocale()] ?? '' !!}
                                        </article>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('what-we-do') }}" class="text-decoration-none text-reset">
                                <div class="card-whatwedo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                    <div class="card-header">
                                        <img src="{{ asset($item['services_img'].'.png') }}" alt="" class="w-100">
                                    </div>
                                    <div class="card-footer">
                                        <h2 class="text-blue-400 fw-bold">{{ $item['services_title'] }}</h2>
                                        <article class="fw-medium lead">
                                            {!! isset($item->id) 
                                                ? ($item->description[app()->getLocale()] ?? '') 
                                                : preg_replace('/<p[^>]*>.*?<\/p>/s', '', $item['services_content']) !!}
                                        </article>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section id="homeprofile">
        @php
            $profiles = $sectionSetting->messages ?? __('wordings.homeProfile_data') ?? [];
        @endphp

        <div id="carouselProfile" class="carousel slide" data-bs-touch="true" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($profiles as $index => $item)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000">
                        <div class="profile-slide d-flex flex-column justify-content-center align-items-center text-center">
                            <div class="profile-image-wrapper">
                                <img 
                                    src="{{ isset($item['messageImage']) 
                                            ? (Str::startsWith($item['messageImage'], 'img/') 
                                                ? asset($item['messageImage'])
                                                : asset('storage/' . $item['messageImage'])) 
                                            : asset('img/icons/default.png') }}"
                                    alt="{{ $item['messageName'] ?? 'Profile' }}" 
                                    class="profile-image img-fluid rounded-circle">
                            </div>
                            <h2 class="profile-text mt-4">
                                {!! $item['messageQuote'][app()->getLocale()] ?? $item['messageQuote'] ?? '' !!}
                            </h2>
                            <div class="profile-divider"></div>
                            <h5 class="mt-3">
                                <strong>{{ $item['messageName'] }}</strong>, {{ $item['messagePosition'] }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProfile" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProfile" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="carouselClients" style="padding: 4rem 0; overflow: hidden;">
        <div class="text-center">
            <div class="row" style="padding: 2rem 0;">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title">
                        <h2 class="d-inline text-green-light fw-bolder display-5">
                            @lang("Our Clients")
                        </h2>
                    </div>
                </div>
            </div>

            <div class="position-relative container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="clients-slider">
                    @foreach ($clients as $client)
                        <div class="client-item text-center">
                            @if (!empty($client->link))
                                <a href="{{ $client->link }}" target="_blank" rel="noopener">
                                    <img src="{{ $client->icon_url }}" alt="{{ $client->name }}" class="img-fluid">
                                </a>
                            @else
                                <img src="{{ $client->icon_url }}" alt="{{ $client->name }}" class="img-fluid">
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Custom arrows -->
                <button type="button" class="slick-prev custom-prev">
                    <img src="{{ asset('img/icons/arrow-grey.png') }}" alt="Prev">
                </button>
                <button type="button" class="slick-next custom-next" style="transform: rotate(180deg);">
                    <img src="{{ asset('img/icons/arrow-grey.png') }}" alt="Next">
                </button>
            </div>
        </div>
    </section>

    <section id="our-team" style="background-image: url('{{ asset('bg-team.jpg') }}')">
        <div class="">
            <div class="row" style="padding: 4rem 0 2rem 0;">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
                        <h1 class="fw-bolder display-5 d-inline text-white">
                            {!! nl2br($sectionSetting->teamTitle[app()->getLocale()] ?? __('wordings.teamTitle')) !!}
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 2rem 0;">
                <div id="carouselTeam" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner container">
                        @foreach ($teams as $team)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row team-member">

                                    {{-- KIRI: Foto & Sertifikat --}}
                                    <div class="col-12 col-md-6 team-left p-0" data-aos="fade-right" data-aos-duration="780">
                                        <div class="photo-section d-flex justify-content-center align-items-center">
                                            <img src="{{ $team->image_url }}"
                                                alt="{{ $team->name }}"
                                                class="image-profile">
                                        </div>

                                        @if ($team->certificate)
                                            <div class="certificate-section d-flex flex-wrap justify-content-center align-items-center gap-3">
                                                @foreach ($team->certificate as $cert)
                                                    @php
                                                        $path = $cert['file'];
                                                        $url = str_starts_with($path, 'img/')
                                                            ? asset($path)
                                                            : asset('storage/'.$path);
                                                    @endphp
                                                    <img src="{{ $url }}" alt="Certificate" class="certificate-logo">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    {{-- KANAN: Deskripsi --}}
                                    <div class="col-12 col-md-6 team-right text-white d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-duration="780">
                                        <div class="desc-team px-5 py-4">
                                            <h1 class="fw-bold mb-2 team-name">{{ $team->name }}</h1>
                                            <div class="team-line mb-3"></div>
                                            <p class="team-desc mb-4">{!! nl2br($team->description[app()->getLocale()] ?? 'What We Do') !!}</p>

                                            @if ($team->socials_array)
                                                <div class="team-socials d-flex gap-3 mt-2">
                                                    @foreach ($team->socials_array as $social)
                                                        @php $icon = $social['platform']; @endphp
                                                        <a href="{{ $social['url'] }}" target="_blank">
                                                            <img src="{{ asset('img/icons/'.$icon.'.png') }}" 
                                                                alt="{{ $icon }}" 
                                                                class="social-icon">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach 
                    </div>

                    {{-- Tombol navigasi custom --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTeam" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTeam" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"
                            style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </section>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll("#carouselTeam .carousel-item");
        let maxHeight = 0;

        items.forEach(item => {
            item.style.height = "auto";
            const h = item.offsetHeight;
            if (h > maxHeight) maxHeight = h;
        });

        items.forEach(item => {
            item.style.height = maxHeight + "px";
        });

        window.addEventListener("resize", () => {
            let newMax = 0;
            items.forEach(item => {
                item.style.height = "auto";
                const h = item.offsetHeight;
                if (h > newMax) newMax = h;
            });
            items.forEach(item => item.style.height = newMax + "px");
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        let homeSplideOptions = {
                perPage: 1,
                perMove: 1,
                arrows: false,
                focus: 'center',
                autoplay: true,
                interval: 5000,
                rewind: true,
                rewindSpeed: 800,
                drag: true,
                mediaQuery: 'min',
                breakpoints: {
                    1024: {
                        drag: false,
                        perPage: 2,
                    }
                }
            };
        const homeSplide = initSplide('.splide', homeSplideOptions);

        const carouselEl = document.getElementById('carouselHome');
        if (!carouselEl || typeof bootstrap === 'undefined') return;

        const carousel = bootstrap.Carousel.getOrCreateInstance(carouselEl);
        const items = () => Array.from(carouselEl.querySelectorAll('.carousel-item'));
        const videos = Array.from(carouselEl.querySelectorAll('video.banner-video'));

        const videoTimes = new Map();

        const pauseAll = () => {
            videos.forEach(v => {
                try {
                    v.pause();
                    videoTimes.set(v.src, v.currentTime);
                } catch (e) {}
            });
        };

        videos.forEach(v => {
            try { 
                v.muted = true;
                v.playsInline = true;
                v.setAttribute('webkit-playsinline', '');
                v.preload = 'metadata';
                v.controls = false;
                v.disablePictureInPicture = true;
                v.controlsList = 'nodownload nofullscreen noremoteplayback';
                v.style.pointerEvents = 'none';
            } catch (e) {}

            v.addEventListener('ended', function() {
                const allItems = items();
                const currentItem = v.closest('.carousel-item');
                const idx = allItems.indexOf(currentItem);
                const nextIndex = (idx + 1) % allItems.length;

                try {
                    carousel.to(nextIndex);
                    carousel.cycle();
                } catch (e) {}
            });
        });

        carouselEl.addEventListener('slide.bs.carousel', function () {
            const active = carouselEl.querySelector('.carousel-item.active');
            if (!active) return;

            const vid = active.querySelector('video.banner-video');
            if (vid) {
                try {
                    videoTimes.set(vid.src, vid.currentTime);
                    vid.pause();
                } catch (e) {}
            }
        });

        carouselEl.addEventListener('slid.bs.carousel', function () {
            pauseAll(); 

            const active = carouselEl.querySelector('.carousel-item.active');
            if (!active) return;

            const vid = active.querySelector('video.banner-video');
            if (vid) {
                try { carousel.cycle(); } catch (e) {}

                const lastTime = videoTimes.get(vid.src) || 0;
                if (lastTime > 0 && lastTime < vid.duration - 0.5) {
                    vid.currentTime = lastTime;
                }

                const playPromise = vid.play();
                if (playPromise && playPromise.catch) {
                    playPromise.catch(()=>{});
                }
            } else {
                try { carousel.cycle(); } catch (e) {}
            }
        });

        (function handleInitial() {
            const active = carouselEl.querySelector('.carousel-item.active');
            if (!active) return;
            const vid = active.querySelector('video.banner-video');
            if (vid) {
                try { carousel.pause(); } catch(e){}
                vid.play().catch(()=>{});
            } else {
                try { carousel.cycle(); } catch(e){}
            }
        })();
    });
</script>
@endpush

