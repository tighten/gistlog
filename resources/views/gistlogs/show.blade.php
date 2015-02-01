@extends('app')

@section('content')
    <div class="container">
        <a href="https://github.com/{{ $gist->author }}" class="profile-pic">
            <img src="{{ $gist->avatarUrl }}">
        </a>

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $gist->title }}</h1>

            <div class="gistlog__content">
                {!! $gist->renderHtml() !!}
            </div>
            <div class="gistlog__meta">
                Created {{ $gist->createdAt->diffForHumans() }} |
                Updated {{ $gist->updatedAt->diffForHumans() }}
            </div>
            <div class="gistlog__links">
                <a href="{{ $gist->link }}">View on Github</a>
            </div>
        </article>
        @if ($gist->hasComments())
            <h3>Comments</h3>

            @foreach ($gist->comments as $comment)
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{ $comment->avatarUrl }}" style="max-width: 100%;">
                    </div>

                    <div class="col-md-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="https://github.com/{{ $comment->user }}">{{ $comment->user }}</a>
                                commented {{ $comment->updatedAt }}
                            </div>
                            <div class="panel-body">
                                {{ $comment->body }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
