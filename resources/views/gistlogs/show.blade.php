@extends('layouts.app')

@section('content')
    <!-- @todo: Fix this, there are some inconsistencies with GitHub,
    and also extract it to a proper stylesheet. Just here for working purposes -->
    <style>
    .highlight {
      background: #fff;
      color: #333;
    }
    .pl-c {
        color: #969896
    }
    .pl-c1,
    .pl-mdh,
    .pl-mm,
    .pl-mp,
    .pl-mr,
    .pl-s1 .pl-v,
    .pl-s3,
    .pl-sc,
    .pl-sv {
        color: #0086b3
    }
    .pl-e,
    .pl-en {
        color: #795da3
    }
    .pl-s1 .pl-s2,
    .pl-smi,
    .pl-smp,
    .pl-stj,
    .pl-vo,
    .pl-vpf {
        color: #333
    }
    .pl-ent {
        color: #63a35c
    }
    .pl-k,
    .pl-s,
    .pl-st {
        color: #a71d5d
    }
    .pl-pds,
    .pl-s1,
    .pl-s1 .pl-pse .pl-s2,
    .pl-sr,
    .pl-sr .pl-cce,
    .pl-sr .pl-sra,
    .pl-sr .pl-sre,
    .pl-src {
        color: #df5000
    }
    .pl-mo,
    .pl-v {
        color: #1d3e81
    }
    .pl-id {
        color: #b52a1d
    }
    .pl-ii {
        background-color: #b52a1d;
        color: #f8f8f8
    }
    .pl-sr .pl-cce {
        color: #63a35c;
        font-weight: bold
    }
    .pl-ml {
        color: #693a17
    }
    .pl-mh,
    .pl-mh .pl-en,
    .pl-ms {
        color: #1d3e81;
        font-weight: bold
    }
    .pl-mq {
        color: #008080
    }
    .pl-mi {
        color: #333;
        font-style: italic
    }
    .pl-mb {
        color: #333;
        font-weight: bold
    }
    .pl-md,
    .pl-mdhf {
        background-color: #ffecec;
        color: #bd2c00
    }
    .pl-mdht,
    .pl-mi1 {
        background-color: #eaffea;
        color: #55a532
    }
    .pl-mdr {
        color: #795da3;
        font-weight: bold
    }
    </style>
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
                <a href="{{ $gistlog->link }}">View on GitHub</a> | <a href="{{ $gistlog->link }}#js-new-comment-form-actions">Comment</a>
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
    <script>
    hljs.configure({ languages: [] });
    hljs.initHighlightingOnLoad();

    $(function() {
        $('.js-gistlog-content pre').each(function () {
            // var numberOfLines = $(this).find('code').html().split(/\n/).length - 1;
            var numberOfLines = $(this).find('> span').length;
            var lineNumbers = [];

            for (var i = 1; i <= numberOfLines; i++) {
                lineNumbers.push(i);
            }

            $(this).append('<div class="line-numbers">' + lineNumbers.join("\n") + '</div>');
        });
    });
    </script>
@endsection
