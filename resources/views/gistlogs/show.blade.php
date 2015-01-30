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
                            <a href="{{ $commentsUrl }}">{{ $commentsCount }} Comments</a> | <a href="{{ $link }}">View on Github</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
