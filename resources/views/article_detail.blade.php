@extends('layouts.app')

@section('content')
    <article>
        <h1>{{ $article->title }}</h1>
        <div>
            {!! $article->content !!}
        </div>
    </article>
@endsection
