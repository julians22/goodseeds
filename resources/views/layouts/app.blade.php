<!doctype html>
<html lang="en">
  <head>

    {{-- Gtag --}}
    @if (config('app.env') === 'production')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CXH0CPZB18"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-CXH0CPZB18');
    </script>

    @endif

    {{-- Recaptcha Script --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome')</title>
    {{-- meta --}}
    <meta name="description" content="@yield('description', 'Welcome')">
    <meta name="keywords" content="@yield('keywords', 'default, keywords')">
    <meta name="author" content="@yield('author', 'designcub3')">
    {{-- favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- FOnts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="canonical" href="{{ url()->current() }}">
    <style>
        .language-switcher-pill {
            /* background: #f0f0f0;  */
            border-radius: 50px;
            padding: 5px;
            display: inline-flex;
            /* border: 1px solid #ddd; */
        }

        .lang-pill-item {
            padding: 8px 15px;
            border-radius: 50px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .active-lang {
            background: #ffffff; 
            color: #000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .pill-divider {
            width: 1px;
            height: 15px;
            background: #ccc;
            margin: 0 5px;
        }

        .active-lang + .pill-divider, 
        .pill-divider:has(+ .active-lang) {
            display: none;
        }
    </style>
    @stack('style')
    {{-- vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  </head>
  <body>

    @include('includes.nav')

    <div id="app">
        <main data-bs-spy="scroll" data-bs-target=".navScrollSpy" data-bs-root-margin="0px 0px -80px" data-bs-smooth-scroll="true">
            @yield('content')
        </main>
    </div>

    
    @include('includes.footer')
    <footer class="py-2 py-md-4 bg-purple">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="fw-semibold text-center text-white mb-0">WEBSITE DESIGN + DEVELOPMENT BY <a class="text-decoration-none text-orange fw-bold" href="https://designcub3.com">DESIGNCUB3.COM</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('floating')

    @stack('scripts')

  </body>
</html>
