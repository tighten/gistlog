@extends('layouts.app')

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $gistlog->title }}">
    <meta itemprop="description" content="{{ $gistlog->getPreview() }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $gistlog->title }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:description" content="{{ $gistlog->getPreview() }}">
    <meta property="og:site_name" content="GistLog">
@endsection

@section('content')
<div class="container gistlog__container">
    <div class="flex flex-col justify-center sm:flex-row sm:justify-end mb-3 sm:mb-auto">
        <gist-star
            gist-id="{{ $gistlog->id }}"
            :is-starred-for-user="{{ json_encode($isStarredForUser) }}"
            :is-logged-in="{{ json_encode(Auth::check()) }}"
        ></gist-star>
        <div class="inline-flex sm:ml-4 shadow rounded w-100 justify-center sm:bg-white">
            <a href="#comments" class="text-sm text-grey-darker rounded-l px-2 py-3 sm:py-1 border-r border-grey-lighter">
                Comments</a>
            <a href="#comments" class="text-sm text-grey-darker rounded-r px-2 py-3 sm:py-1">{{ $gistlog->commentCount }} </a>
        </div>
    </div>
    @if ($gistlog->isAnonymous())
        <div class="avatar">
            <img src="{{ $gistlog->avatarUrl }}" alt="{{ $gistlog->author }} - {{ config('app.name') }}">
        </div>
    @else
        <div class="avatar">
            <a href="/{{ $gistlog->author }}" target="_blank">
                <img src="{{ $gistlog->avatarUrl }}" alt="{{ $gistlog->author }} - {{ config('app.name') }}">
            </a>
        </div>
    @endif
    <div class="py-8 gistlog sm:px-8">
        <article class="px-4 my-8 sm:px-8">
            <h1 class="gistlog__title" v-pre>{{ $gistlog->title }}</h1>
            <span class="table mx-auto font-light" v-pre>
                @if ($gistlog->isAnonymous())
                    by <span class="font-bold no-underline text-blue-dark">{{ $gistlog->author }}</span>
                @else
                    by <a href="/{{ $gistlog->author }}" class="font-bold no-underline text-blue-dark">{{ $gistlog->author }}</a>
                @endif
            </span>

            <div class="gistlog__content">
                <div v-pre>
                    {!! $gistlog->renderHtml() !!}
                    @if ($gistlog->showFiles())
                        <hr/>
                        <h3>
                            Attached Files ({{ $gistlog->files->count() }})
                        </h3>
                        <div class="gistlog__files">
                            @if ($gistlog->files->isEmpty())
                                <p>
                                    <em>
                                        No files to display.
                                    </em>
                                </p>
                            @else
                                @foreach ($gistlog->files as $file)
                                    <p>
                                        <a href="{{ $file->url }}" target="_blank">{{ $file->name }}</a>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        <hr/>
                    @endif

                    <div class="mt-8 mb-2 text-xs text-grey-darker">
                        Created {{ $gistlog->createdAt->diffForHumans() }} |
                        Updated {{ $gistlog->updatedAt->diffForHumans() }}
                    </div>

                    <div>
                        <a
                            class="text-xs no-underline text-blue"
                            href="{{ $gistlog->link }}"
                            target="_blank"
                        >View on GitHub</a>
                    </div>
                </div>

                <div class="pt-4 mb-8">
                    <h2 class="mb-2 text-2xl" id="comments">Comments ({{ $gistlog->commentCount }})</h2>

                    @include('gistlogs.comment_form')

                    <gist-comments gist-author="{{ $gistlog->author }}" gist-id="{{ $gistlog->id }}"></gist-comments>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        (function() {
            autosize(document.querySelectorAll('textarea'));
        })();
    </script>
@endpush
