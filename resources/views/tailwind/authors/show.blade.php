@extends('tailwind.layouts.app')

@section('content')
    <div class="container mx-auto gistlog__container my-8">
        {{-- Avatar --}}
        <div class="avatar">
            <a href="https://github.com/{{ $author->username }}" target="_blank">
                <img src="{{ $author->avatarUrl }}" alt="{{ $author->username }} - {{ config('app.name') }}">
            </a>
        </div>
        <div class="gistlog py-8 sm:px-8">
            <section class="my-8 px-4 sm:px-8 my-8">
                <h1 class="gistlog__title">{{ $author->name }}</h1>
                <div class="font-light mx-auto table">
                    <span class="font-bold text-grey no-underline">{{ '@' . $author->username }}</span>
                </div>

                <section class="mt-8 pt-6 gistlog__content">
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