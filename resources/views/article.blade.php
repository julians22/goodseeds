@extends('layouts.app')

@section('title', $meta->meta_title[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('description', $meta->meta_description[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('keywords', implode(',', $meta->meta_keywords[app()->getLocale()] ?? []))

@section('content')
  <main class="py-5" style="background:#f1f2f2;">
    <div class="container">
      <!--Section: Content-->
      <section>
        <div class="row">   
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h1 class="page__title">
                        {!! nl2br($sectionSetting->articleTitle[app()->getLocale()]) ?? $pageAttributes['title']  !!}
                    </h1>
                </div>
            </div>
        </div>

        <div class="row" style="padding: 2rem 0;">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h4 class="page__description">
                        {!! $sectionSetting->articleDescription[app()->getLocale()] ?? $pageAttributes['description'] !!}
                    </h4>
                </div>
            </div>
        </div>

        <div class="mt-4 row g-4 card-article">
            @foreach ($articles as $item)
              <div class="col-lg-4 col-md-6">
                <a href="{{ route('insight-detail', $item->slug) }}" class="text-decoration-none text-reset">
                    <div class="card-whatwedo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="card-header">
                            <img src="{{ $item->getFirstMediaUrl('thumbnail') }}" class="img-fluid" />
                        </div>
                        <div class="card-footer">
                            <h5 class="text-blue-400 fw-bold">{{ $item->title }}</h5>
                            <p class="fw-medium lead success-excerpt">
                                {{ $item->excerpt }}
                            </p>
                        </div>
                    </div>
                </a>
              </div>
            @endforeach
        </div>
      </section>

      <div class="mt-10">
        @if ($articles->hasPages())
            <div class="custom-pagination">
                @if ($articles->onFirstPage())
                    <span class="page-link disabled">&lsaquo;</span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="page-link">&lsaquo;</a>
                @endif

                @for ($page = 1; $page <= $articles->lastPage(); $page++)
                    @if ($page == $articles->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $articles->url($page) }}" class="page-link">{{ $page }}</a>
                    @endif
                @endfor

                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="page-link">&rsaquo;</a>
                @else
                    <span class="page-link disabled">&rsaquo;</span>
                @endif
            </div>
        @endif
    </div>
    </div>
  </main>
  <!--Main layout-->


@endsection
