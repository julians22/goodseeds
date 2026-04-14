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
                <div  class="align-items-stretch row gx-0 gy-0 service-item">
                    @if($loop->iteration % 2 == 1)
                        <div class="col-md-6 service-image" data-aos="fade-right" data-aos-duration="900" data-aos-easing="ease-in-out">
                            <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                        </div>
                        <div class="d-flex flex-column justify-content-center col-md-6 service-text" data-aos="fade-left" data-aos-duration="900" data-aos-easing="ease-in-out" style="background:#f1f2f2;">
                            <div class="p-5">
                                <h2 class="fw-bold">{{ $item->name }}</h2>
                                <article class="fw-medium lead">
                                    {!! $item->description[app()->getLocale()] ?? '' !!}
                                </article>
                            </div>
                        </div>
                    @else
                        <div class="order-md-2 col-md-6 service-image" data-aos="fade-left" data-aos-duration="900" data-aos-easing="ease-in-out">
                            <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                        </div>
                        <div class="d-flex flex-column justify-content-center order-md-1 col-md-6 service-text" data-aos="fade-right" data-aos-duration="900" data-aos-easing="ease-in-out" style="background:#f1f2f2;">
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
                        <div class="mt-lg-2">
                            <div class="text-center lead fw-medium" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">
                                {!! $item->description[app()->getLocale()] ?? '' !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('includes.view.ourteams')
  </main>
  <!--Main layout-->
@endsection
