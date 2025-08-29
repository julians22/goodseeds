<nav class="fixed-top bg-body-tertiary navbar navbar-expand-lg" id="custom-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>
                <img src="{{ $settings['headerLogo'] }}" alt="" width="249">
            </span>
        </a>
        <ul class="ms-auto mb-2 mb-lg-0 navbar-nav">
            <li class="nav-item">
                <a class="nav-link fw-bold" aria-current="page" href="#what-we-do">@lang("OUR SERVICES")</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="#our-approach">@lang("OUR APPROACH")</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="#our-team">@lang("OUR TEAM")</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ route('article') }}">@lang("ARTICLE")</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="#contact">@lang("CONTACT US")</a>
            </li>
        </ul>
        <div class="dropdown language-dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $currentLocale = App::getLocale();
                @endphp
                {{ strtoupper($currentLocale) }}
            </button>
            @if (Route::isLocalized() || Route::isFallback())
            <ul class="dropdown-menu">
                @foreach(LocaleConfig::getLocales() as $locale)
                    @if ( ! App::isLocale($locale))
                        <li>
                            <a class="dropdown-item" href="{{ Route::localizedUrl($locale) }}">
                                {{ strtoupper($locale) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</nav>

<nav id="mobile-custom-nav" class="fixed-top bg-body-tertiary py-0 navbar navScrollSpy">
    <div class="d-flex align-items-center justify-content-between h-100 container">
        <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="#">
            <span>
                <img src="{{ $settings['headerLogo'] }}" alt="" width="249">
            </span>
        </a>
    </div>
    <div class="menu">
      <ul>
        <li>
            <a class="nav-link fw-bold" aria-current="page" href="#what-we-do">OUR SERVICES</a>
        </li>
        <li>
            <a class="nav-link fw-bold" href="#our-approach">OUR APPROACH</a>
        </li>
        <li>
            <a class="nav-link fw-bold" href="#our-team">OUR TEAM</a>
        </li>
        <li>
            <a class="nav-link fw-bold" href="#contact">CONTACT US</a>
        </li>
      </ul>
    </div>
  </nav>


