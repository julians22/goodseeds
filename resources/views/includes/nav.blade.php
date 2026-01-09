<nav class="fixed-top bg-body-tertiary navbar navbar-expand-lg" id="custom-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>
                <img src="{{ $settings['headerLogo'] }}" alt="" width="249">
            </span>
        </a>
        <ul class="ms-auto mb-2 mb-lg-0 navbar-nav">
            <li class="nav-item">
                <a class="nav-link fw-bold {{ request()->routeIs('*.what-we-do') ? 'active' : '' }}"
                    href="{{ route('what-we-do') }}">
                    @lang("WHAT WE DO")
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold {{ request()->routeIs('*.success-story*') ? 'active' : '' }}"
                    href="{{ route('success-story') }}">
                    @lang("SUCCESS STORY")
                </a>            
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold {{ request()->routeIs('*.insight*') ? 'active' : '' }}"
                    href="{{ route('insight') }}">
                    @lang("INSIGHTS")
                </a>  
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="#contact">@lang("CONTACT US")</a>
            </li>
        </ul>
        {{-- <div class="dropdown language-dropdown">
            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $currentLocale = App::getLocale();
                @endphp
                <img src="{{ asset('img/flags/' . $currentLocale . '.png') }}" 
                    alt="{{ $currentLocale }}" width="20" class="me-2">
                <span class="nav-link fw-bold">{{ strtoupper($currentLocale) }}</span>
            </button>

            @if (Route::isLocalized() || Route::isFallback())
            <ul class="dropdown-menu">
                @foreach(LocaleConfig::getLocales() as $locale)
                    @if ( ! App::isLocale($locale))
                        <li>
                            <a class="dropdown-item" href="{{ Route::localizedUrl($locale) }}">
                                <img src="{{ asset('img/flags/' . $locale . '.png') }}" alt="{{ $locale }}" width="20">
                                {{ strtoupper($locale) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            @endif
        </div> --}}

        {{-- <div class="dropdown language-dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $currentLocale = App::getLocale();
                @endphp
                {{ strtoupper($currentLocale) }}
            </button>

            @php
                $currentRouteName = Route::currentRouteName();
                $currentRouteParameters = Route::current()->parameters();

                $slugs = [];

                if ($currentRouteName === 'success-story-detail' && isset($currentRouteParameters['slug'])) {
                    $currentSlug = $currentRouteParameters['slug'];

                    $successModel = \App\Models\Success::where("slug->{$currentLocale}", $currentSlug)->first();

                    if (!$successModel) {
                        $allSuccess = \App\Models\Success::all();
                        $successModel = $allSuccess->first(function ($item) use ($currentLocale, $currentSlug) {
                            $slugs = $item->slug;
                            return isset($slugs[$currentLocale]) && $slugs[$currentLocale] === $currentSlug;
                        });
                    }

                    if ($successModel) {
                        $slugs = $successModel->slug;
                    }
                }
                
            @endphp

            <ul class="dropdown-menu">
                @foreach(LocaleConfig::getLocales() as $locale)
                    @if ($locale !== $currentLocale)
                        @php
                            $params = $currentRouteParameters;

                            // Jika di halaman detail success story, ganti slug ke slug bahasa target
                            if ($currentRouteName === 'success-story-detail' && isset($slugs[$locale])) {
                                $params['slug'] = $slugs[$locale];
                            }

                            $url = Route::localizedUrl($locale, $params);
                        @endphp
                        <li>
                            <a class="dropdown-item" href="{{ $url }}">
                                {{ strtoupper($locale) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div> --}}
    </div>
</nav>

<nav id="mobile-custom-nav" class="fixed-top bg-body-tertiary py-0 navbar navScrollSpy">
    <div class="d-flex align-items-center justify-content-between h-100 container">
        <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="{{ route('home') }}">
            <span>
                <img src="{{ $settings['headerLogo'] }}" alt="" width="249">
            </span>
        </a>
    </div>
    <div class="menu">
      <ul>
        <li class="nav-item">
            <a class="nav-link fw-bold {{ request()->routeIs('*.what-we-do') ? 'active' : '' }}"
                href="{{ route('what-we-do') }}">
                @lang("WHAT WE DO")
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold {{ request()->routeIs('*.success-story*') ? 'active' : '' }}"
                href="{{ route('success-story') }}">
                @lang("SUCCESS STORY")
            </a>            
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold {{ request()->routeIs('*.insight*') ? 'active' : '' }}"
                href="{{ route('insight') }}">
                @lang("INSIGHTS")
            </a>  
        </li>
        <li>
            <a class="nav-link fw-bold" href="#contact">CONTACT US</a>
        </li>
      </ul>
    </div>
  </nav>


