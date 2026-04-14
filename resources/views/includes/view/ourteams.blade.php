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
            <div id="carouselTeam" class="carousel slide">
                <div class="carousel-inner container">
                    @foreach ($teams as $team)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row team-member">

                                <div class="col-12 col-md-6 team-left p-0 no-cert" data-aos="fade-right" data-aos-duration="780">
                                    <div class="photo-section d-flex justify-content-center align-items-center">
                                        <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="image-profile">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 team-right text-white d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-duration="780">
                                    <div class="desc-team px-5 py-4 position-relative"> {{-- Tambahkan position-relative di sini --}}
                                        
                                        @if ($team->certificate)
                                            <div class="certificate-container-top-right">
                                                @foreach ($team->certificate as $cert)
                                                    @php
                                                        $path = $cert['file'];
                                                        $url = str_starts_with($path, 'img/') ? asset($path) : asset('storage/'.$path);
                                                    @endphp
                                                    <img src="{{ $url }}" alt="Certificate" class="certificate-logo-mini">
                                                @endforeach
                                            </div>
                                        @endif

                                        <h1 class="fw-bold mb-2 team-name">{{ $team->name }}</h1>
                                        <div class="team-line mb-3"></div>
                                        <div class="team-desc mb-4">{!! nl2br($team->description[app()->getLocale()] ?? 'What We Do') !!}</div>

                                        @if ($team->socials_array)
                                            <div class="team-socials d-flex gap-3 mt-2">
                                                @foreach ($team->socials_array as $social)
                                                    @php $icon = $social['platform']; @endphp
                                                    <a href="{{ $social['url'] }}" target="_blank">
                                                        <img src="{{ asset('img/icons/'.$icon.'.png') }}" alt="{{ $icon }}" class="social-icon">
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

@push('style')
<style>
    .desc-team.position-relative {
        position: relative !important;
    }

    .certificate-container-top-right {
        position: absolute;
        top: -20px;    
        right: 0px;  
        display: flex;
        flex-direction: column; 
        z-index: 5;
        align-items: flex-end; 
    }

    .certificate-logo-mini {
        max-height: 90px; 
        width: auto;      
        object-fit: contain;
        display: block;
    }

    @media (max-width: 768px) {
        .certificate-container-top-right {
            position: relative; 
            top: 0;
            right: 0;
            margin-bottom: 20px;
            flex-direction: row; 
            justify-content: center;
        }
    }
</style>
@endpush