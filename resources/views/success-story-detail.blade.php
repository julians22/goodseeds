@extends('layouts.app')

@section('title', $success->meta['title'][app()->getLocale()] ?? $success->title)
@section('description', $success->meta['description'][app()->getLocale()] ?? $success->excerpt)
@section('keywords', implode(',', $success->meta['keywords'][app()->getLocale()] ?? []))

@section('content')
<main class="py-5" style="background:#f1f2f2;">
    <div class="container success-detail">
        <div class="row">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h1 class="page__title">
                        {!! nl2br($success->getTranslation('title', app()->getLocale())) !!}
                    </h1>
                </div>
            </div>
        </div>

        <div class="row" style="padding: 2rem 0;">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h5 class="d-inline">
                        {!! $success->getTranslation('excerpt', app()->getLocale()) !!}
                    </h5>
                </div>
            </div>
        </div>
    </div> 

    @if ($success->getFirstMediaUrl('featured_image'))
        <div class="success-featured-image" data-aos="zoom-in" data-aos-duration="900" data-aos-easing="ease-in-out">
            <img src="{{ $success->getFirstMediaUrl('featured_image') }}" alt="{{ $success->title }}" class="img-fluid w-100">
        </div>
    @endif

    <div class="container success-detail">
        <div class="row">
            <div class="col-md-12">
                <div class="article-detail-content" data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-in-out" class="success-detail-content" style="overflow-x:auto;">
                    {!! $success->getTranslation('content', app()->getLocale()) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if ($previous || $next)
            <div class="d-flex justify-content-between mt-5" data-aos="fade-down" data-aos-duration="900" data-aos-easing="ease-in-out">
                @if ($previous)
                    <a href="{{ route('success-story-detail', $previous->slug) }}" 
                       class="btn-nav">
                        &lt; @lang("wordings.prevPage")
                    </a>
                @else
                    <div></div>
                @endif

                @if ($next)
                    <a href="{{ route('success-story-detail', $next->slug) }}" 
                       class="btn-nav">
                        @lang("wordings.nextPage") &gt;
                    </a>
                @endif
            </div>
        @endif
    </div>
    
</main>
@endsection
