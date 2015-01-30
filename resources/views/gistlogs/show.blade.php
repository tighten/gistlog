@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a href="https://github.com/{{ $userName }}" class="profile-pic">
                    <img src="{{ $userPhotoUrl }}">
                </a>

                <div class="panel panel-default">
                    <div class="panel-heading gistlog__title">{{ $title }}</div>
                    <div class="panel-body gistlog__content">
                        {!! $content !!}
                    </div>
                    <div class="panel-footer">
                        <div class="gistlog__meta">
                            Created {{ $createdDate->format('Y-m-d') }} |
                            Updated {{ $updatedDate->format('Y-m-d') }}
                        </div>
                        <div class="gistlog__links">
                            <a href="{{ $link }}">View on Github</a>
                        </div>
                    </div>
                </div>
                @if ($commentsCount > 0)
                    <h3>Comments</h3>

                    @foreach ($comments as $comment)
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ $comment->user->avatar_url }}" style="max-width: 100%;">
                            </div>

                            <div class="col-md-11">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="https://github.com/{{ $comment->user->login }}">{{ $comment->user->login }}</a>
                                        commented {{ $comment->updated_at }}
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
