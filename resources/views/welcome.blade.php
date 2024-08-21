@extends('layouts.app')

@section('title', $settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS')

@section('content')

    <section id="home">
        <div id="carouselHome" class="carousel slide " data-bs-touch="true" data-bs-ride="true">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}" data-bs-interval="3000">
                    <img src="{{$banner->image_url}}" class="d-block w-100 banner-image"/>
                    <div class="carousel-caption d-none d-lg-block">
                        @if (count($banner->titles_array))
                        <div class="text-banner container fw-bold">
                            @foreach ($banner->titles_array as $title)
                                <span style="color: {{$title["color"]}}">{{$title["word"]}}</span><br>
                            @endforeach
                        </div>
                        @endif
                    </div>
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

    <section id="placeholder" class="d-block d-md-none">
        <h1 class="display-4 text-center fw-bolder" data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
            @if (count($primaryText->titles_array))
            <div class="text-banner container fw-bold">
                @foreach ($primaryText->titles_array as $title)
                    <span style="color: {{$title["color"]}}">{{$title["word"]}}</span>
                @endforeach
            </div>
            @endif
        </h1>
    </section>


    <section id="services" class="bg-body-secondary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="text-center lead fw-md-medium editor-body">
                        {!! tiptap_converter()->asHTML($sectionSetting->aboutDescription) !!}
                    </div>
                    {{-- <p class="">We are a consulting firm on a mission to empower business owners to scale up and sustain their enterprises by delivering end-to-end, customized solutions, including consulting, coaching & mentoring, training, and recruitment. Our approach is tailored to meet your specific needs and goals. We focus on creating long- term value by setting the right strategy, optimizing your business operations, and nurturing your people for sustained growth.</p> --}}
                </div>
            </div>
        </div>
    </section>

    <section id="what-we-do">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
                        <h2 class="fw-bolder display-5 d-inline text-green-light">
                            WHAT WE DO
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row gx-0 gy-5 gx-md-5 mt-2 mt-lg-5">

                @foreach ($services as $item)
                    <div class="col-md-6">
                        <div class="card-whatwedo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            <div class="card-header">
                                <img src="{{ $item->image_url }}" alt="" class="w-100">
                            </div>

                            <div class="card-footer" style="background-image: url('{{ asset('card-footer.jpg') }}')">
                                <h2 class="text-white fw-bold">{{ $item->name }}</h2>
                                <article class="fw-medium lead">
                                    {!! $item->description !!}
                                </article>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="how-we-do-it" style="background-image: url('{{ asset('bg-what-you-get.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
                        <h2 class="fw-bolder display-5 d-inline text-green-light">
                            WHAT YOU GET
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row gx-0 gy-5 gx-md-5 mt-2 mt-lg-5">
                <div class="col-lg-6">
                    <div class="card-whatyouget fw-medium lead" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        Holistic, customized and structured approach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-whatyouget fw-medium lead" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        Dedicated professionals with diverse backgrounds and extensive experience in Business & Organization Development, and Human Resources Management
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-whatyouget fw-medium lead" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        Systematic methodology
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-whatyouget fw-medium lead" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        Practical and applicable guidance that shortens your learning curve and minimizes trial and error
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="diagram" class="overflow-hidden pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 d-none d-md-block">
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
    </section>
    <section id="our-approach" class="pt-0">
        <div class="spacer"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
                        <h2 class="fw-bolder display-5 d-inline text-green-light">
                            OUR APPROACH
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="editor-body text-center lead fw-medium">
                        {!! tiptap_converter()->asHTML($sectionSetting->approachDescription) !!}
                    </div>
                </div>
            </div>

            <div class="row mt-5 gy-lg-0 gy-2">
                <div class="col-lg-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-approach icon-why mb-3">
                            <img src="{{ asset('img/icons/why.png') }}" alt="" width="100" data-aos="fade-right">
                        </div>
                        <span class="d-block text-green-light fw-bolder display-5" data-aos="fade-right" data-aos-duration="780">WHY</span>
                    </div>
                    <div class="mt-lg-2">
                        <p class="text-center lead fw-medium" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">Growth means stepping out of your comfort zone. It requires consistency and perseverance to grow, scale, and sustain success. A strong "WHY" energizes and drives you every morning. We help you to understand your purpose that fuels your passion and commitment to success.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-approach icon-what mb-3 me-lg-3">
                            <img src="{{ asset('img/icons/what.png') }}" alt="" width="100" data-aos="fade-right">
                        </div>
                        <span class="d-block text-green-light fw-bolder display-5" data-aos="fade-right" data-aos-duration="780">WHAT</span>
                    </div>
                    <div class="mt-lg-2">
                        <p class="text-center lead fw-medium" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">We help you to set specific, measurable goals, identify quick wins, and establish clear directions to reach your targets. Clear objectives and milestones ensure tangible progress and sustained motivation throughout the journey.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-approach icon-how mb-3">
                            <img src="{{ asset('img/icons/how.png') }}" alt="" width="100" data-aos="fade-right">
                        </div>
                        <span class="d-block text-green-light fw-bolder display-5" data-aos="fade-right" data-aos-duration="780">HOW</span>
                    </div>
                    <div class="mt-lg-2">
                        <p class="text-center lead fw-medium" data-aos="fade-right" data-aos-delay="150" data-aos-duration="700">
                            We create step-by-step, actionable plans that adopt best practices while being custom-fit to your unique situation. Our tailored approach ensures that solutions are effective, practical, and relevant to your business context.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="our-team" style="background-image: url('{{ asset('bg-team.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center">
                        <h2 class="fw-bolder display-5 d-inline text-white">
                            OUR TEAM
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row mt-2 mt-lg-5">

                <div class="col-md-12">

                    <div class="splide" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                              <ul class="splide__list">
                                @foreach ($teams as $item)
                                    <li class="splide__slide">
                                        <div class="card-team">
                                            <div class="d-flex flex-column align-items-center">
                                                <img src="{{ $item->image_url }}" alt="" class="team-image rounded-circle">
                                                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title text-center mt-4">
                                                    <span class="fw-bolder d-inline text-white h3">
                                                        {{ $item->name }}
                                                    </span>
                                                </div>
                                                <p class="mt-4 lead text-center fw-medium">
                                                    {{ $item->description }}
                                                </p>
                                                @if ($item->socials_array)
                                                    @foreach ($item->socials_array as $item)
                                                        <span class="team-social-icon">
                                                            <a href="{{ $item['url'] }}" target="_blank">
                                                                @php
                                                                    $icon = $item['platform'];
                                                                @endphp
                                                                <img src="{{ asset('img/icons/'.$icon.'.png') }}" alt="">
                                                            </a>
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                              </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="contact" class="bg-blue-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="title under-green text-center">
                        <h2 class="fw-bolder display-5 d-inline text-white">
                            CONTACT US
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row mt-2 mt-lg-5 d-flex flex-column-reverse flex-md-row">
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <img src="{{ $settings['footerLogo'] }}" alt="" class="img-fluid mb-4" width="350">
                    <p class="lead text-white">{!! $settings['siteAddress'] !!}</p>
                    <div class="row gx-1">
                        @foreach ($settings['socialMediaLinks'] as $item)
                            <div class="col-1">
                                <a href="{{ $item['link'] }}" class="d-block"><img src="{{ $item['icon'] }}" alt="" class="img-fluid w-100"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="{{ route('secure-contact') }}" method="POST" id="contact-form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12">
                              <input type="text" name="name" class="form-control custom-form" autocomplete="name" placeholder="Full Name" aria-label="Full Name" required>
                            </div>
                            <div class="col-12">
                              <input type="text" name="company" class="form-control custom-form" autocomplete="work" placeholder="Company" aria-label="Company" required>
                            </div>
                            <div class="col-12">
                              <input type="email" name="email" class="form-control custom-form" autocomplete="email" placeholder="Email" aria-label="Email" required>
                            </div>
                            <div class="col-12">
                              <input type="text" name="phone" class="form-control custom-form" autocomplete="mobile" placeholder="Phone Number" aria-label="Phone Number">
                            </div>
                            <div class="col-12">
                                <textarea name="message" id="message" rows="5" placeholder="Message" class="form-control custom-form"></textarea>
                            </div>
                            <div class="col-12 d-flex">
                                <button type="submit" class="btn btn-green-light ms-auto d-inline-block px-5 text-white fw-medium">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // init splide js
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


        // Handel submit contact-form
        storeFormData();

    });

    function storeFormData() {
        const form = document.getElementById('contact-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            let url = form.getAttribute('action');

            axios.post(url, data)
                .then(response => {
                    form.reset();

                    let data = response.data;
                    let name = data.contact.name;

                    alert('Thank you, ' + name + '. Your message has been sent successfully.');
                })
                .catch(error => {
                    console.error(error);

                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;
                        let message = '';
                        for (const key in errors) {
                            message += errors[key][0] + '\n';
                        }
                        alert(message);
                    } else {
                        alert('Something went wrong. Please try again later.');
                    }
                });
        });
    }
</script>

@endpush
