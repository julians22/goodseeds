@extends('layouts.app')

@section('title', $meta->meta_title[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('description', $meta->meta_description[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('keywords', implode(',', $meta->meta_keywords[app()->getLocale()] ?? []))

@section('content')

    <section id="home">
        <div id="carouselHome" class="carousel slide" data-bs-touch="true" data-bs-ride="true">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}" data-bs-interval="3000">
                    <img src="{{$banner->image_url}}" class="d-block w-100 banner-image"/>
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

    <section id="placeholder" class="py-5">
        <div class="container">
            <div class="row align-items-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="col-md-5" style="padding-bottom:2rem;">
                    <div class="text-banner fw-bold">
                        @foreach (preg_split('/\r\n|\r|\n/', $sectionSetting->aboutTitle[app()->getLocale()] ?? __('wordings.homeAbout_title')) ?? '' as $i => $line)
                            <span class="line {{ $i >= 2 ? 'green' : '' }}">
                                {{ $line }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="text-left lead fw-md-medium editor-body">
                        <h3>{!! $sectionSetting->aboutDescription[app()->getLocale()] ?? __('wordings.homeAbout_text') ?? '' !!}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="supports">
        <div class="container my-5">
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

        <div id="carouselProfile" class="carousel slide" data-bs-touch="true" data-bs-ride="true">
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

    <section class="carouselClients" style="background: #f1f2f2; padding: 4rem 0;">
        <div class="text-center" >
            <div class="row" style="padding: 2rem 0;">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title">
                        <h2 class="d-inline text-green-light fw-bolder display-5">
                            @lang("CLIENTS")
                        </h2>
                    </div>
                </div>
            </div>
            <div id="carouselClients" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner container">
                    @foreach ($clients->chunk(5) as $chunkIndex => $chunk)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-center">
                                @foreach ($chunk as $client)
                                    <div class="mx-3">
                                        @if ($client->link)
                                            <a href="{{ $client->link }}" target="_blank" rel="noopener">
                                                <img src="{{ $client->icon_url }}" 
                                                    alt="{{ $client->name }}" 
                                                    class="img-fluid">
                                            </a>
                                        @else
                                            <img src="{{ $client->icon_url }}" 
                                                alt="{{ $client->name }}" 
                                                class="img-fluid">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselClients" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselClients" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>

    <section id="home-team" style="background-image: url('{{ asset('bg-team.jpg') }}')">
        <div class="">
            <div class="container">
                <div class="row" style="padding: 4rem 0 2rem 0;">
                    <div class="col-md-12">
                        <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title">
                            <h2 class="d-inline text-white fw-bolder display-5">
                                {!! nl2br($sectionSetting->teamTitle[app()->getLocale()] ?? __('wordings.teamTitle')) !!}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding: 0 0 2rem 0;">
                    <div class="col-md-12">
                        <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                            <h4 class="text-white expert-text">
                                {!! $sectionSetting->teamDescription[app()->getLocale()] ?? __('wordings.teamDescription') !!}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container">
                    <div id="carouselHomeTeam" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $teamsList = $teams->isNotEmpty()
                                    ? $teams
                                    : collect($experts)->map(fn($item) => (object)[
                                        'name' => $item['name'],
                                        'image_url' => asset($item['image']),
                                    ]);

                                $n = count($teamsList);
                            @endphp                         
                            @for ($i = 0; $i < $n; $i++)
                                @php
                                    $big = $teamsList[$i];
                                    $small = $teamsList[($i + 1) % $n];
                                @endphp

                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                    <div class="team-slide d-flex align-items-center justify-content-center">
                                        <div class="team-card big d-flex align-items-center text-white">
                                            <div class="team-name">
                                                <h2>{{ $big->name }}</h2>
                                            </div>
                                            <div class="team-photo">
                                                <img src="{{ $big->image_url }}" alt="{{ $big->name }}">
                                            </div>
                                        </div>

                                        <div class="team-card small text-center">
                                            <div class="team-photo">
                                                <img src="{{ $small->image_url }}" alt="{{ $small->name }}">
                                            </div>
                                            <div class="team-name text-white">
                                                <h3>{{ $small->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomeTeam" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"
                                style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselHomeTeam" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"
                                style="background-image: url('{{ asset('img/icons/arrow.png') }}'); transform: rotate(180deg);"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
@endpush