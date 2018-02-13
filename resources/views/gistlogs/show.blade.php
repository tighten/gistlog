@extends('layouts.app')

@section('content')
    <div class="gistlog__container container">
        @if ($gistlog->isAnonymous())
            <div class="avatar">
                <img src="{{ $gistlog->avatarUrl }}" alt="{{ $gistlog->author }} - {{ config('app.name') }}">
            </div>
        @else
            <div class="avatar">
                <a href="https://github.com/{{ $gistlog->author }}" target="_blank">
                    <img src="{{ $gistlog->avatarUrl }}" alt="{{ $gistlog->author }} - {{ config('app.name') }}">
                </a>
            </div>
        @endif
        <div class="gistlog py-8 sm:px-8">
            <article class="my-8 px-4 sm:px-8 my-8">
                <h1 class="gistlog__title">{{ $gistlog->title }}</h1>
                <span class="font-light mx-auto table">
                    @if ($gistlog->isAnonymous())
                        by <span class="font-bold text-blue no-underline">{{ $gistlog->author }}</span>
                    @else
                        by <a href="/{{ $gistlog->author }}" class="font-bold text-blue no-underline">{{ $gistlog->author }}</a>
                    @endif
                </span>

                <div class="gistlog__content">
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
                                    @foreach($gistlog->files as $file)
                                        <p>
                                            <a href="{{ $file->url }}" target="_blank">{{ $file->name }}</a>
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                            <hr/>
                        @endif

                    {{-- Meta --}}
                    <div class="text-xs text-grey mb-2">
                        Created {{ $gistlog->createdAt->diffForHumans() }} |
                        Updated {{ $gistlog->updatedAt->diffForHumans() }}
                    </div>
                    <div>
                        <a  class="text-xs text-blue no-underline" href="{{ $gistlog->link }}" target="_blank">View on GitHub</a>
                    </div>

                    {{-- Comments --}}
                    <div class="my-8 pt-4">
                        <h3>Comments {{ (count($gistlog->comments) > 0) ? '(' . count($gistlog->comments) . ')' : '' }}</h3>

                        @include('gistlogs.comment_form')

                        @if ($gistlog->hasComments())
                        @foreach ($gistlog->comments as $comment)
                            @include('gistlogs.comment', ['gistlog' => $gistlog, 'comment' => $comment])
                        @endforeach
                        @endif
                    </div>
                </div>
            <article>
        </article>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        (function() {
            autosize(document.querySelectorAll('textarea'));
        })();
    </script>
@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $gistlog->title }}">
    <meta itemprop="description" content="{{ $gistlog->getPreview() }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $gistlog->title }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:description" content="{{ $gistlog->getPreview() }}">
    <meta property="og:site_name" content="Gistlog">
@endsection
