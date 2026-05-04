@extends('layouts.app')

@section('title', $article->meta['title'][app()->getLocale()] ?? $article->title)
@section('description', $article->meta['description'][app()->getLocale()] ?? $article->excerpt)
@section('keywords', implode(',', $article->meta['keywords'][app()->getLocale()] ?? []))

@section('content')
<main class="py-5" style="background:#f1f2f2;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h1 class="page__title">
                        {!! nl2br($article->getTranslation('title', app()->getLocale())) !!}
                    </h1>
                </div>
            </div>
        </div>

        <div class="row" style="padding: 2rem 0;">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    <h5 class="d-inline">
                        {!! $article->getTranslation('excerpt', app()->getLocale()) !!}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    @if ($article->getFirstMediaUrl('featured_image'))
        <div class="article-featured-image" data-aos="zoom-in" data-aos-duration="900" data-aos-easing="ease-in-out">
            <img src="{{ $article->getFirstMediaUrl('featured_image') }}" alt="{{ $article->title }}" class="img-fluid w-100">
        </div>
    @endif

    <div class="container article-detail">
        <div class="row">
            <div class="col-md-12">
                <div data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-in-out" class="article-detail-content" style="overflow-x:auto;">
                    {!! $article->getTranslation('content', app()->getLocale()) !!}
                </div>
            </div>
        </div>

        @if ($previous || $next)
            <div class="d-flex justify-content-between mt-5" data-aos="fade-down" data-aos-duration="900" data-aos-easing="ease-in-out">
                @if ($previous)
                    <a href="{{ route('insight-detail', $previous->slug) }}" 
                       class="btn-nav">
                        &lt; @lang("wordings.prevPage")
                    </a>
                @else
                    <div></div>
                @endif

                @if ($next)
                    <a href="{{ route('insight-detail', $next->slug) }}" 
                       class="btn-nav">
                        @lang("wordings.nextPage") &gt;
                    </a> 
                @endif
            </div>
        @endif
    </div>
</main>
@endsection
