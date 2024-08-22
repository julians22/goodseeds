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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | {{ appName() }}</title>
    {{-- meta --}}
    <meta name="description" content="@yield('description', 'Welcome')">
    <meta name="author" content="@yield('author', 'designcub3')">
    {{-- favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- FOnts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">


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

    <footer class="py-2 py-md-4 bg-purple">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="fw-semibold text-center text-white mb-0">WEBSITE DESIGN + DEVELOPMENT BY <a class="text-decoration-none text-orange fw-bold" href="https://designcub3.com">DESIGNCUB3.COM</a></p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

  </body>
</html>
