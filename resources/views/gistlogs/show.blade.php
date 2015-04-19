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
        @if ($gistlog->hasComments())
            <h3>Comments</h3>

            @foreach ($gistlog->comments as $comment)
                @include ('gistlogs.comment', ['gistlog' => $gistlog, 'comment' => $comment])
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
    $(function() {
        var preElement = $('.js-gistlog-content pre').each(function (index) {
            var lineNumbers = '<div class="line-numbers">';
            var numberOfLines = $(this).find('code').html().split(/\n/).length - 1;

            for (var i = 1; i <= numberOfLines; i++) {
                lineNumbers = lineNumbers + i.toString() + "\n";
            }

            lineNumbers = lineNumbers + '</div>';

            $(this).append(lineNumbers);
        });
    });

    </script>
@endsection
