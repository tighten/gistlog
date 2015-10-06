@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="https://github.com/{{ $gistlog->author }}" class="profile-pic">
            <img src="{{ $gistlog->avatarUrl }}">
        </a>

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $gistlog->title }}</h1>
            <span class="gistlog__author">By <a href="/{{ $gistlog->author }}">{{ $gistlog->author }}</a></span>

            <div class="gistlog__content js-gistlog-content">
                {!! $gistlog->renderHtml() !!}
            </div>
            <div class="gistlog__meta">
                Created {{ $gistlog->createdAt->diffForHumans() }} |
                Updated {{ $gistlog->updatedAt->diffForHumans() }}
            </div>
            <div class="gistlog__links">
                <a href="{{ $gistlog->link }}">View on GitHub</a>
            </div>
        </article>
            <h3>Comments</h3>

            @include('gistlogs.comment_form')

        @if ($gistlog->hasComments())
            @foreach ($gistlog->comments as $comment)
                @include ('gistlogs.comment', ['gistlog' => $gistlog, 'comment' => $comment])
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <script src="/js/commentForm.js"></script>
@endsection

@section('meta')
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ $gistlog->title }}">
        <meta itemprop="description" content="{{ $gistlog->getPreview() }}">

        <!-- Open Graph data -->
        <meta property="og:title" content="{{ $gistlog->title }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:description" content="{{ $gistlog->getPreview() }}">
        <meta property="og:site_name" content="Gistlog">
@endsection
