@extends('layouts.app')

@section('title', $meta->meta_title[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('description', $meta->meta_description[app()->getLocale()] ?? ($settings['siteTitle'] ?? 'NURTURE PEOPLE EMPOWER BUSINESS'))
@section('keywords', implode(',', $meta->meta_keywords[app()->getLocale()] ?? []))

@section('content')
<main class="py-5" style="background:#f1f2f2;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h1 class="page__title">
                        {!! nl2br($sectionSetting->successStoryTitle[app()->getLocale()]) ?? $wordings['successTitle']  !!}
                    </h1>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 2rem 0;">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h4 class="page__description">
                        {!! $sectionSetting->successStoryDescription[app()->getLocale()] ?? $wordings['successText'] !!}
                    </h4>
                </div>
            </div>
        </div>
        <div class="mt-4 row">
            @foreach ($SuccessStories as $item)
                <div class="col-md-4">
                    <a href="{{ route('success-story-detail', $item->slug) }}" class="text-decoration-none text-reset">
                    {{-- <a href="{{ route('success-story-detail', $item->getTranslatedSlug(app()->getLocale()))."-".$item->id }}" class="text-decoration-none text-reset"> --}}
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
    </div>

    <div class="mt-10">
        @if ($SuccessStories->hasPages())
            <div class="custom-pagination">
                @if ($SuccessStories->onFirstPage())
                    <span class="page-link disabled">&lsaquo;</span>
                @else
                    <a href="{{ $SuccessStories->previousPageUrl() }}" class="page-link">&lsaquo;</a>
                @endif

                @for ($page = 1; $page <= $SuccessStories->lastPage(); $page++)
                    @if ($page == $SuccessStories->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $SuccessStories->url($page) }}" class="page-link">{{ $page }}</a>
                    @endif
                @endfor

                @if ($SuccessStories->hasMorePages())
                    <a href="{{ $SuccessStories->nextPageUrl() }}" class="page-link">&rsaquo;</a>
                @else
                    <span class="page-link disabled">&rsaquo;</span>
                @endif
            </div>
        @endif
    </div>
</main>
@endsection