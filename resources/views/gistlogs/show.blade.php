@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a href="https://github.com/{{ $gist->author }}" class="profile-pic">
                    <img src="{{ $gist->avatarUrl }}">
                </a>

                <div class="panel panel-default">
                    <div class="panel-heading gistlog__title">{{ $gist->title }}</div>
                    <div class="panel-body gistlog__content">
                        {!! $gist->renderHtml() !!}
                    </div>
                    <div class="panel-footer">
                        <div class="gistlog__meta">
                            Created {{ $gist->createdAt->format('Y-m-d') }} |
                            Updated {{ $gist->updatedAt->format('Y-m-d') }}
                        </div>
                        <div class="gistlog__links">
                            <a href="{{ $gist->link }}">View on Github</a>
                        </div>
                    </div>
                </div>
                @if (count($gist->comments) > 0)
                    <h3>Comments</h3>

                    @foreach ($gist->comments as $comment)
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ $comment->user->avatar_url }}" style="max-width: 100%;">
                            </div>

                            <div class="col-md-11">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="https://github.com/{{ $comment->user->login }}">{{ $comment->user }}</a>
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
        </div>
    </div>
@endsection
