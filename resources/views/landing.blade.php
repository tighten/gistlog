@extends('layouts.app')

@section('meta')
<meta name="author" content="Matt Stauffer">
<meta name="description" content="Your dev blog - delivered! GistLog allows you to publish your blog posts via simple GitHub gists.">
<meta name="robots" content="index, follow">

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="GistLog - Your dev blog delivered">
<meta itemprop="description" content="Your dev blog - delivered! GistLog allows you to publish your blog posts via simple GitHub gists.">

<!-- Open Graph data -->
<meta property="og:title" content="GistLog - Your dev blog delivered">
<meta property="og:type" content="product">
<meta property="og:image" content="{{ asset('img/gistlog-og.png') }}">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:description" content="Your dev blog - delivered! GistLog allows you to publish your blog posts via simple GitHub gists.">
<meta property="og:site_name" content="GistLog">
@endsection

@section('styles')
<link href="/css/landing.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-6 mx-auto">
    <h1 class="mb-2 text-3xl font-light md:text-5xl md:font-hairline text-blue-darkest">Your Dev Blog Delivered</h1>
    <h2 class="mb-6 text-base tracking-normal md:text-2xl text-grey-darker md:mb-8">Publish your first post in 55 seconds</h2>

    <button
        onclick="window.location.href = '/posts/create'"
        class="inline-block px-6 py-2 my-2 text-white rounded bg-blue-darker md:text-lg focus:outline-none"
    >Get Started</button>
</div>

<div class="img-cover blue-overlay" style="background-image: url('/img/main-bg.jpg')" title="Dev Blog - {{ config('app.name') }}"></div>

<div class="w-full pt-8 pb-6  bg-grey-lightest">
    <div class="container py-6 mx-auto text-center">
        <h3 class="text-3xl font-light md:text-4xl text-blue-darkest">How it works</h3>
        <div class="w-10 mx-auto my-4 border-b-2 border-solid border-blue-darkest"></div>
        <p class="mx-auto my-6 text-base leading-normal md:w-4/5 text-grey-darker-darker md:px-8">In just a few steps&mdash;and just a few seconds&mdash;you can be blogging using nothing but simple GitHub Gists and Markdown.</p>
    </div>

    <div class="py-1 mx-auto mb-6 md:hidden">
        <div class="mb-5 tab-label">
            <span>1</span>
            <div class="w-full ml-3 text-sm">
                <h4 class="font-bold text-blue">Create a Gist</h4>
                <p class="py-1 text-grey-darker">Create a GitHub Gist with Markdown</p>
                <img
                    src="{{ asset('img/step1.jpg') }}"
                    alt="Step 1 - create Gist"
                    class="mt-5 border rounded shadow-md border-grey-light"
                >
            </div>
        </div>

        <div class="mb-5 tab-label">
            <span>2</span>
            <div class="w-full ml-3 text-sm">
                <h4 class="font-bold text-blue">Paste the Link</h4>
                <p class="py-1 text-grey-darker">Paste your Gist's URL into GistLog</p>
                <img
                    src="{{ asset('img/step2.jpg') }}"
                    alt="Step 2 - paste Gist link"
                    class="mt-5 border rounded shadow-md border-grey-light"
                >
            </div>
        </div>

        <div class="tab-label">
            <span>3</span>
            <div class="w-full ml-3 text-sm">
                <h4 class="font-bold text-blue">Share your Post</h4>
                <p class="py-1 text-grey-darker">Share your GistLog link 🎉</p>
                <img
                    src="{{ asset('img/step3.jpg') }}"
                    alt="Step 3 - share your post"
                    class="mt-5 border rounded shadow-md border-grey-light"
                >
            </div>
        </div>
    </div>

    <home-page-tabs></home-page-tabs>
</div>

<div class="w-full py-6 bg-white">
    <div class="container pt-4 pb-2 mx-auto text-center">
        <h3 class="text-3xl font-light md:text-4xl text-blue-darkest">Everything you need</h3>
        <div class="w-10 mx-auto my-4 border-b-2 border-solid border-blue-darkest"></div>
        <p class="mx-auto my-6 text-base leading-normal md:w-4/5 text-grey-darker-darker md:px-8">GistLog posts may be easy to create, but we didn't skimp on features. All the features you expect from a developer-focused blogging platform, with almost no setup.</p>
    </div>
</div>

<div class="container flex flex-col items-center py-12 mx-auto leading-normal sm:flex-row">
    <div class="flex-1 mb-8 text-center md:mb-0">
        <figure class="w-32 mx-auto lg:px-4 sm:mx-8 min-h-6 sm:w-auto">
            <img src="{{ asset('img/icon-responsive.svg') }}" alt="Responsive design - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-lg text-blue-darkest sm:text-base">Responsive out of the box</p>
    </div>

    <div class="flex-1 mb-8 text-center md:mb-0">
        <figure class="w-32 mx-auto lg:px-4 sm:mx-8 min-h-6 sm:w-auto">
            <img src="{{ asset('img/icon-comments.svg') }}" alt="Built-in comments - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-lg text-blue-darkest sm:text-base">Built-in comments &amp; notifications</p>
    </div>

    <div class="flex-1 mb-8 text-center md:mb-0">
        <figure class="w-32 mx-auto lg:px-4 sm:mx-8 min-h-6 sm:w-auto">
            <img src="{{ asset('img/icon-easy.svg') }}" alt="Easy &amp; Fast - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-lg text-blue-darkest sm:text-base">Easy &amp; Fast</p>
    </div>

    <div class="flex-1 text-center">
        <figure class="w-32 mx-auto lg:px-4 sm:mx-8 min-h-6 sm:w-auto">
            <img src="{{ asset('img/icon-markdown.svg') }}" alt="Write with Markdown - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-lg text-blue-darkest sm:text-base">Write with Markdown</p>
    </div>
</div>
@endsection
