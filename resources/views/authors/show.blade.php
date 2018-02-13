@extends('layouts.app')

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
                    <span class="font-bold text-grey no-underline">{{ '@' . $author->username }}</span>
                </div>

                <section class="gistlog__content">
                    <ul class="list-reset">
                        @foreach ($author->gists as $gist)
                            <li>
                                <a class="text-black text-xl" href="/{{ $author->username }}/{{ $gist->id }}">{{ $gist->title }}</a>
                                <span class="block text-xs">
                                    Posted {{ $gist->createdAt->diffForHumans() }}
                                </span>
                                <p>
                                    {{ $gist->getPreview() }}&hellip;
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </section>
        </div>
    </div>
@endsection
