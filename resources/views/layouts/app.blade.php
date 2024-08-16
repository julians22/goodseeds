<!doctype html>
<html lang="en">
  <head>
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
      @yield('content')
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
