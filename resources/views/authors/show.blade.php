@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="gistlog-author-block">
            <a href="https://github.com/{{ $author->username }}" class="profile-pic">
                <img src="{{ $author->avatarUrl }}">
            </a>
            <h1 class="gistlog__title">{{ $author->name }}</h1>
            <span class="gistlog__author">({{ "@" . $author->username }})</span>
        </section>

        <section>
            <ul class="list-unstyled">
                @foreach ($author->gists as $gist)
                    <li class="gistlog-article">
                         <a href="/{{ $author->username }}/{{ $gist->id }}" class="gistlog-article__title">{{ $gist->title }}</a>
                        <span class="gistlog-article__timestamp">
                            Posted {{ $gist->createdAt->diffForHumans() }}
                        </span>
                        <p class="gistlog-article__summary">
                            {{ $gist->getPreview() }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
