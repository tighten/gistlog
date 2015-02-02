@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="https://github.com/{{ $gistlog->author }}" class="profile-pic">
            <img src="{{ $gistlog->avatarUrl }}">
        </a>

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $gistlog->title }}</h1>

            <div class="gistlog__content">
                {!! $gistlog->renderHtml() !!}
            </div>
            <div class="gistlog__meta">
                Created {{ $gistlog->createdAt->diffForHumans() }} |
                Updated {{ $gistlog->updatedAt->diffForHumans() }}
            </div>
            <div class="gistlog__links">
                <a href="{{ $gistlog->link }}">View on Github</a>
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
@endsection
