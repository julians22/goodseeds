@php
    $currentLocale = App::getLocale();

    $currentRouteName = Route::currentRouteName();
    $currentRouteParameters = Route::current()?->parameters() ?? [];

    $localizedSlugs = [];

    // ARTICLE DETAIL
    if (
        str_ends_with($currentRouteName, 'insight-detail')
        && isset($currentRouteParameters['slug'])
    ) {

        $currentSlug = $currentRouteParameters['slug'];

        $article = \App\Models\Article::where(function ($query) use ($currentSlug) {
            $query->where('slug', $currentSlug)
                ->orWhere('slug_en', $currentSlug)
                ->orWhere('slug_id', $currentSlug);
        })->first();

        if ($article) {

            $localizedSlugs = [
                'en' => $article->slug_en ?: $article->slug,
                'id' => $article->slug_id ?: $article->slug,
            ];
        }
    }
@endphp

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
                <a class="nav-link fw-bold" href="#contact">
                    @lang("CONTACT US")
                </a>
            </li>

        </ul>

        {{-- DESKTOP LANGUAGE --}}
        <div class="dropdown language-dropdown">

            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <img src="{{ asset('img/flags/' . $currentLocale . '.png') }}"
                    alt="{{ $currentLocale }}"
                    width="20"
                    class="me-2">

                <span class="nav-link fw-bold">
                    {{ strtoupper($currentLocale) }}
                </span>
            </button>

            @if (Route::isLocalized() || Route::isFallback())

                <ul class="dropdown-menu">

                    @foreach(LocaleConfig::getLocales() as $locale)

                        @if (!App::isLocale($locale))

                            @php
                                $params = $currentRouteParameters;

                                // ganti slug sesuai locale
                                if (
                                    str_ends_with($currentRouteName, 'insight-detail')
                                    && isset($localizedSlugs[$locale])
                                ) {
                                    $params['slug'] = $localizedSlugs[$locale];
                                }

                                $url = Route::localizedUrl($locale, $params);
                            @endphp

                            <li>
                                <a class="dropdown-item" href="{{ $url }}">

                                    <img src="{{ asset('img/flags/' . $locale . '.png') }}"
                                        alt="{{ $locale }}"
                                        width="20">

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

{{-- MOBILE NAV --}}
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
                <a class="nav-link fw-bold" href="#contact">
                    @lang("CONTACT US")
                </a>
            </li>

            {{-- MOBILE LANGUAGE --}}
            <li class="nav-item mt-3">

                <div class="language-switcher-pill d-flex align-items-center">

                    @php
                        $locales = collect(LocaleConfig::getLocales())->sort();
                    @endphp

                    @foreach($locales as $locale)

                        @php
                            $isActive = (App::getLocale() == $locale);

                            $params = $currentRouteParameters;

                            if (
                                str_ends_with($currentRouteName, 'insight-detail')
                                && isset($localizedSlugs[$locale])
                            ) {
                                $params['slug'] = $localizedSlugs[$locale];
                            }

                            $url = Route::localizedUrl($locale, $params);
                        @endphp

                        <a href="{{ $url }}"
                            class="lang-pill-item {{ $isActive ? 'active-lang' : '' }} d-flex align-items-center">

                            <img src="{{ asset('img/flags/' . $locale . '.png') }}"
                                width="20"
                                class="me-2">

                            <span>{{ strtoupper($locale) }}</span>
                        </a>

                        @if (!$loop->last)
                            <div class="pill-divider"></div>
                        @endif

                    @endforeach

                </div>

            </li>

        </ul>

    </div>

</nav>