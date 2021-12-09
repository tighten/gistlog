@extends('layouts.app')

@section('meta')
<link rel="alternate" type="application/atom+xml" title="RSS Feed for {{ $author->username }} on GistLog" href="{{ route('authors.rss.show', $author->username) }}" />
@endsection

@section('content')
<div class="container gistlog__container">
    <div class="avatar">
        <a href="https://github.com/{{ $author->username }}" target="_blank">
            <img src="{{ $author->avatarUrl }}" alt="{{ $author->username }} - {{ config('app.name') }}">
        </a>
    </div>

    <div class="gistlog">
        <section class="px-4 my-8 sm:px-8">
            <h1 class="gistlog__title">{{ $author->name }}</h1>

            <div class="table mx-auto font-light">
                <span class="font-bold no-underline text-blue-dark">
                    {{ '@' . $author->username }}
                </span>
            </div>

            <section class="gistlog__content">
                @foreach ($author->gists as $gist)
                <div class="mb-12">
                    <a href="/{{ $author->username }}/{{ $gist->id }}" class="text-2xl font-medium">{{ $gist->title }}</a>

                    <span class="block mb-3 text-sm">
                        Posted {{ $gist->createdAt->diffForHumans() }}
                    </span>

                    <p>{{ $gist->getPreview() }}&hellip;</p>
                </div>
                @endforeach
            </section>
            @if ($author->bio)
            <section class="mx-auto text-gray-500 border-t border-gray-200 mt-14" style="max-width: 612px">
                <h2 class="mt-6 mb-1 text-xl text-gray-700">About {{ $author->name }}</h2>
                <div>{{ $author->bio }}</div>
            </section>
            @endif
        </section>
    </div>
</div>
@endsection
