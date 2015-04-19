@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="https://github.com/{{ $author->username }}" class="profile-pic">
            <img src="{{ $author->avatarUrl }}">
        </a>

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $author->name }}</h1>
            <span class="gistlog__author">({{ "@" . $author->username }})</span>

            <ul>
                @foreach ($author->gists as $gist)
                    <li>{{ $gist->createdAt->format('Y-m-d') }} - <a href="/{{ $author->username }}/{{ $gist->id }}">{{ $gist->title }}</a></li>
                @endforeach
            </ul>
        </article>
    </div>
@endsection
