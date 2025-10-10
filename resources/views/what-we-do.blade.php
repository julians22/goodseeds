@extends('layouts.app')

@section('title', $meta->meta_title[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'What We Do'))
@section('description', $meta->meta_description[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'What We Do'))
@section('keywords', implode(',', $meta->meta_keywords[app()->getLocale()] ?? []))


@section('content')
  <!--Main layout-->
  <main>
    <div class="pt-5" style="background: #f1f2f2;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                        <h1 class="page__title">
                            {!! nl2br($sectionSetting->servicesNewTitle[app()->getLocale()] ?? __('wordings.whatServicesTitle')) !!}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 2rem 0;">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                        <h4 class="d-inline">
                            {!! $sectionSetting->servicesDescription[app()->getLocale()] ?? __('wordings.whatServicesDescription') !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="services-section">
            @foreach ($services as $item)
                <div  class="row align-items-stretch gx-0 gy-0 service-item">
                    @if($loop->iteration % 2 == 1)
                        <div class="col-md-6 service-image" data-aos="fade-right" data-aos-duration="900" data-aos-easing="ease-in-out">
                            <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6 service-text d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-duration="900" data-aos-easing="ease-in-out" style="background:#f1f2f2;">
                            <div class="p-5">
                                <h2 class="fw-bold">{{ $item->name }}</h2>
                                <article class="fw-medium lead">
                                    {!! $item->description[app()->getLocale()] ?? '' !!}
                                </article>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 order-md-2 service-image" data-aos="fade-left" data-aos-duration="900" data-aos-easing="ease-in-out">
                            <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6 order-md-1 service-text d-flex flex-column justify-content-center" data-aos="fade-right" data-aos-duration="900" data-aos-easing="ease-in-out" style="background:#f1f2f2;">
                            <div class="p-5">
                                <h2 class="fw-bold">{{ $item->name }}</h2>
                                <article class="fw-medium lead description-list">
                                    {!! $item->description[app()->getLocale()] ?? '' !!}
                                </article>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <section id="our-approach" class="pb-12 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title">
                        <h2 class="d-inline text-green-light fw-bolder display-5">
                            {!! nl2br($sectionSetting->approachTitle[app()->getLocale()] ?? 'What We Do') !!}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="justify-content-center mt-5 row">
                <div class="d-md-block col-10 d-none">
                    <img src="{{ asset('diagram-01.png') }}"
                        class="w-100"
                        alt=""
                        data-aos="fade-up"
                        data-aos-duration="1500"
                        data-aos-delay="100">
                </div>

                <div class="col-12 d-md-none">
                    <img src="{{ asset('diagram.png') }}"
                        class="w-100"
                        alt=""
                        data-aos="fade-up"
                        data-aos-duration="1500"
                        data-aos-delay="100">
                </div>
            </div>
        </div>
        {{-- <div class="spacer"></div> --}}
        <div class="container">
            <div class="mt-5 row">
                <div class="col-md-12">
                    <div class="text-center editor-body lead fw-medium">
                        <h4>
                            {!! $sectionSetting->approachDescription[app()->getLocale()] ?? '' !!}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="mt-5 row gy-lg-0 gy-2">
                @foreach ($approaches as $item)
                    <div class="col-lg-4">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mb-3 icon-approach icon-why">
                                <img src="{{ $item->icon_url }}" alt="" width="100" data-aos="fade-right">
                            </div>
                            <span class="d-block fw-bolder display-5" data-aos="fade-right" data-aos-duration="780" style="color: #0193dd; padding: 2.5rem 0 0.4rem 0 ;">{!! $item->title[app()->getLocale()] ?? '' !!}</span>
                        </div>
                        <div class="mt-lg-2 ">
                            <div class="text-center lead fw-medium" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">
                                {!! $item->description[app()->getLocale()] ?? '' !!}
                            </div>
                        </div>
                    </div>
                @endforeach
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
  </main>
  <!--Main layout-->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll("#carouselTeam .carousel-item");

    function setEqualHeights() {
        items.forEach(item => item.style.height = "auto");

        let maxHeight = 0;

        items.forEach(item => {
            const wasHidden = item.classList.contains('active') ? false : true;
            if (wasHidden) item.classList.add('temp-show'); 
            item.style.display = 'block'; 

            const h = item.scrollHeight;
            if (h > maxHeight) maxHeight = h;

            if (wasHidden) item.style.display = ''; 
            item.classList.remove('temp-show');
        });

        items.forEach(item => item.style.height = maxHeight + "px");
    }

    window.addEventListener("load", setEqualHeights);
    window.addEventListener("resize", setEqualHeights);
});
</script>
@endpush