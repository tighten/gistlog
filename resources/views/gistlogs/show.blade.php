@extends('layouts.app')

@section('content')
    <div class="container">
        @if($gistlog->isAnonymous())
            <span class="profile-pic">
                <img src="{{ $gistlog->avatarUrl }}">
            </span>
        @else
            <a href="https://github.com/{{ $gistlog->author }}" class="profile-pic">
                <img src="{{ $gistlog->avatarUrl }}">
            </a>
        @endif

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $gistlog->title }}</h1>
            @if($gistlog->isAnonymous())
                <span class="gistlog__author">By {{ $gistlog->author }}</span>
            @else
                <span class="gistlog__author">By <a href="/{{ $gistlog->author }}">{{ $gistlog->author }}</a></span>
            @endif


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
            <h3>Comments {{ (count($gistlog->comments) > 0) ? '(' . count($gistlog->comments) . ')' : '' }}</h3>

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
    <script>
    $(function() {
        commentForm.init();

        // $('.js-gistlog-content pre').each(function () {
        //     var numberOfLines = $(this).find('code').html().split(/\n/).length - 1;
        //     var lineNumbers = [];
        //     for (var i = 1; i <= numberOfLines; i++) {
        //         lineNumbers.push(i);
        //     }
        //     $(this).append('<div class="line-numbers">' + lineNumbers.join("\n") + '</div>');
        // });
        autosize($('textarea'));
    });
    </script>
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
