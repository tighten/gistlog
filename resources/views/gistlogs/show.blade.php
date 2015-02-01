@extends('app')

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
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{ $comment->avatarUrl }}" style="max-width: 100%;">
                    </div>

                    <div class="col-md-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="https://github.com/{{ $comment->author }}">{{ $comment->author }}</a>
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
