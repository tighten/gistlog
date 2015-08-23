@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="https://github.com/{{ $gistlog->author }}" class="profile-pic">
            <img src="{{ $gistlog->avatarUrl }}">
        </a>

        <article class="gistlog">
            <h1 class="gistlog__title">{{ $gistlog->title }}</h1>
            <span class="gistlog__author">By <a href="/{{ $gistlog->author }}">{{ $gistlog->author }}</a></span>

            <div class="gistlog__content js-gistlog-content">
                {!! $gistlog->renderHtml() !!}
            </div>
            <div class="gistlog__meta">
                Created {{ $gistlog->createdAt->diffForHumans() }} |
                Updated {{ $gistlog->updatedAt->diffForHumans() }}
            </div>
            <div class="gistlog__links">
                <a href="{{ $gistlog->link }}">View on GitHub</a> | <a href="{{ $gistlog->link }}#new_comment_field">Comment</a>
            </div>
        </article>
            <h3>Comments</h3>

            @include('gistlogs.comment_form')

        @if ($gistlog->hasComments())
            @foreach ($gistlog->comments as $comment)
                @include ('gistlogs.comment', ['gistlog' => $gistlog, 'comment' => $comment])
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <script>
    hljs.configure({ languages: [] });
    hljs.initHighlightingOnLoad();

    var commentForm = (function(){

    	var el = {
    		$comment_input: $('#comment_input'),
            $comment_buttons_container: $('.comment-form__button-container'),
            $github_signin: $('#github_signin')
    	};

    	var bindUIElements = function() {
            el.$comment_input.on('focus', showCommentButton);
            el.$comment_input.on('blur', hideCommentButton);
    		el.$github_signin.on('click', handleSignin);
    	};

    	var init = function() {
    		bindUIElements();
            refillPreviousComment();
    	};

        var handleSignin = function (e) {
            var comment = el.$comment_input.val();
            localStorage.setItem('gist_comment', comment);
        };

        var showCommentButton = function () {
            el.$comment_buttons_container.addClass('active');
        };

        var hideCommentButton = function () {
            if(el.$comment_input.val() === "") el.$comment_buttons_container.removeClass('active');
        };

        var refillPreviousComment = function () {
            if(localStorage.hasOwnProperty('gist_comment') === false) return false;
            el.$comment_input.val(localStorage.getItem('gist_comment'));
            localStorage.removeItem('gist_comment');
            showCommentButton();
        };

    	return {
    		init: init
    	}

    })();

    commentForm.init();

    $(function() {
        $('.js-gistlog-content pre').each(function () {
            var numberOfLines = $(this).find('code').html().split(/\n/).length - 1;
            var lineNumbers = [];

            for (var i = 1; i <= numberOfLines; i++) {
                lineNumbers.push(i);
            }

            $(this).append('<div class="line-numbers">' + lineNumbers.join("\n") + '</div>');
        });

        autosize($('textarea'));
    });
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
