@extends('layouts.app')

@section('title', $article->meta['title'][app()->getLocale()] ?? $article->title)
@section('description', $article->meta['description'][app()->getLocale()] ?? $article->excerpt)
@section('keywords', implode(',', $article->meta['keywords'][app()->getLocale()] ?? []))

@section('content')
<style>
    .pageTitle{
        text-align: center;
        font-weight: bold;
        position: relative;
    }

    .pageTitle-top{
        color: #abcd03; 
    }

    .pageTitle-bottom{
        color: #00a0e9; 
    }

    .pageTitle::after{
        content: "";
        display: inline-block;
        width: 10%;
        height: 4px;

        background-color: #00a0e9; 

        position: absolute;
        bottom: -18px;

        left: 50%;
        transform: translateX(-50%);
    }

    .article-detail-content blockquote {
        position: relative;
        background: #00a0e9;
        color: #fff;
        border: none;
        padding: 24px 60px;
        border-radius: 0;
        margin: 24px 0;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
    }

    .article-detail-content blockquote p {
        margin: 0;
    }

    .article-detail-content blockquote::before {
        content: "❝";
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 40px;
        line-height: 1;
    }

    .article-detail-content blockquote::after {
        content: "❞";
        position: absolute;
        bottom: 10px;
        right: 15px;
        font-size: 40px;
        line-height: 1;
    }

    .article-detail-content {
        overflow: hidden; 
        text-align: left !important; 

    }
    
    @media (max-width: 768px) {
        .d-inline {
            font-size: 1rem !important;
        }

        .article-detail-content h2, .article-detail-content h3, .article-detail-content h4, .article-detail-content h5, .article-detail-content h6, .article-detail-content h1 {
            font-size: 1.6rem !important;
            text-align: left !important; 
        }

        .article-detail-content p {
            font-size: 1rem !important; 
        }

        .article-detail-content .filament-tiptap-grid-builder {
            grid-template-columns: 1fr !important;
        }
    }

    .table-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    }

    .table-scroll table {
        min-width: 600px;
        border-collapse: separate;
        border-spacing: 24px 0;
    }

    .article-detail-content table td {
        vertical-align: top;
    }

    .article-detail-content table td:first-child {
        text-align: center;
    }

    .article-detail-content table td:first-child img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .article-detail-content table td:first-child p {
        margin-top: 0;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .table-scroll {
            overflow-x: visible;
        }

        .article-detail-content table td:first-child img {
            display: block;
            margin-left: 0;
            margin-right: auto;
        }

        .article-detail-content table,
        .article-detail-content tbody,
        .article-detail-content tr,
        .article-detail-content td {
            display: block;
            width: 100% !important;
        }

        .article-detail-content table {
            min-width: 100% !important;
            border-spacing: 0;
        }

        .article-detail-content tr {
            margin-bottom: 2rem;
        }

        .article-detail-content td {
            padding: 0;
        }

        /* gambar */
        .article-detail-content td:first-child {
            margin-bottom: 1rem;
            text-align: left; 
        }

        .article-detail-content td:first-child img {
            display: block;
            width: auto;
            height: 75px;
            max-width: 100%;
            margin: 0; 
        }
    }
</style>
<main class="py-5" style="background:#f1f2f2;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center">
                    @php
                        $title = preg_split('/<br\s*\/?>/i', nl2br($article->getTranslation('title', app()->getLocale())));
                    @endphp

                    <h1 class="pageTitle">
                        <span class="pageTitle-top">
                            {!! $title[0] ?? '' !!}
                        </span>

                        @if(isset($title[1]))
                            <br>
                            <span class="pageTitle-bottom">
                                {!! $title[1] !!}
                            </span>
                        @endif
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
                <div data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-in-out" class="article-detail-content">
                    @php
                        $rawContent = $article->getTranslation('content', app()->getLocale());

                        if (is_array($rawContent)) {
                            $content = tiptap_converter()->asHtml($rawContent);
                        } elseif (is_string($rawContent)) {
                            $decoded = json_decode($rawContent, true);

                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                $content = tiptap_converter()->asHtml($decoded);
                            } else {
                                $content = $rawContent;
                            }
                        } else {
                            $content = '';
                        }

                        $content = preg_replace('/<table/', '<div class="table-scroll"><table', $content);
                        $content = preg_replace('/<\/table>/', '</table>div>', $content);
                    @endphp

                    {!! $content !!}
                </div>
            </div>
        </div>
        <div class="container article-detail">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>

        @if ($previous || $next)
            <div class="d-flex justify-content-between mt-5" data-aos="fade-down" data-aos-duration="900" data-aos-easing="ease-in-out">
                @if ($previous)
                    <a href="{{ route('insight-detail', $previous->localized_slug) }}" 
                       class="btn-nav">
                        &lt; @lang("wordings.prevPage")
                    </a>
                @else
                    <div></div>
                @endif

                @if ($next)
                    <a href="{{ route('insight-detail', $next->localized_slug) }}" 
                       class="btn-nav">
                        @lang("wordings.nextPage") &gt;
                    </a> 
                @endif
            </div>
        @endif
    </div>
</main>
@endsection
