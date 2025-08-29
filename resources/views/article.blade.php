@extends('layouts.app')

@section('title', $pageAttributes['title_browser'] ?? 'Article')
@section('description', $pageAttributes['description_browser'] ?? 'Article Description')


@section('content')


  <!--Main layout-->
  <main class="py-5">
    <div class="container">
      <!--Section: Content-->
      <section>
        <h1 class="mb-5 page__title">{!! $pageAttributes['title'] !!}</h1>

        <p class="page__description">{!! $pageAttributes['description'] !!}</p>

        <div class="mt-4 row">

            @foreach ($articles as $article)
            <div class="mb-4 col-lg-4 col-md-12">
                <div class="card">
                    <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                        <img src="{{ $article->getFirstMediaUrl('thumbnail') }}" class="img-fluid" />
                        <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">
                            {{ $article->excerpt }}
                        </p>
                        <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Read</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
      </section>
      <!--Section: Content-->

      <!-- Pagination -->
      <nav class="my-4" aria-label="...">
        <ul class="justify-content-center pagination pagination-circle">
          <li class="page-item">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </main>
  <!--Main layout-->


@endsection
