@extends('layouts.app')

@section('meta')
<link
    rel="alternate"
    type="application/atom+xml"
    title="RSS Feed for {{ $author->username }} on GistLog"
    href="{{ route('authors.rss.show', $author->username) }}" />
@endsection

@section('content')
<div class="gistlog__container container">
    <div class="avatar">
        <a href="https://github.com/{{ $author->username }}" target="_blank">
            <img src="{{ $author->avatarUrl }}" alt="{{ $author->username }} - {{ config('app.name') }}">
        </a>
    </div>

    <div class="gistlog">
        <section class="my-8 px-4 sm:px-8 my-8">
            <h1 class="gistlog__title">{{ $author->name }}</h1>

            <div class="font-light mx-auto table">
                <span class="font-bold text-blue-dark no-underline">
                    {{ '@' . $author->username }}
                </span>
            </div>

            <section class="gistlog__content">
                @foreach ($author->gists as $gist)
                <div class="mb-12">
                    <a href="/{{ $author->username }}/{{ $gist->id }}" class="text-2xl font-medium">{{ $gist->title }}</a>

                    <span class="block text-sm mb-3">
                        Posted {{ $gist->createdAt->diffForHumans() }}
                    </span>

                    <p>{{ $gist->getPreview() }}&hellip;</p>
                </div>
                @endforeach
            </section>
        </section>
    </div>
</div>
@endsection
