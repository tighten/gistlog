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
<div class="container mx-auto py-6">
    <h1 class="text-3xl md:text-5xl font-light md:font-hairline text-blue-darkest mb-2">Your Dev Blog Delivered</h1>
    <h2 class="text-base md:text-2xl text-grey-darker tracking-normal mb-6 md:mb-8">Publish your first post in 55 seconds</h2>

    <button
        onclick="window.location.href = '/posts/create'"
        class="inline-block bg-blue-darker text-white md:text-lg rounded focus:outline-none my-2 py-2 px-6"
    >Get Started</button>
</div>

<div class="img-cover blue-overlay" style="background-image: url('/img/main-bg.jpg')" title="Dev Blog - {{ config('app.name') }}"></div>

<div class=" bg-grey-lightest w-full pt-8 pb-6">
    <div class="container mx-auto text-center py-6">
        <h3 class="text-3xl md:text-4xl font-light text-blue-darkest">How it works</h3>
        <div class="w-10 border-solid border-b-2 border-blue-darkest mx-auto my-4"></div>
        <p class="md:w-4/5 mx-auto text-grey-darker-darker leading-normal text-base md:px-8 my-6">In just a few steps&mdash;and just a few seconds&mdash;you can be blogging using nothing but simple GitHub Gists and Markdown.</p>
    </div>

    <div class="md:hidden mx-auto mb-6 py-1">
        <div class="tab-label mb-5">
            <span>1</span>
            <div class="w-full ml-3 text-sm">
                <h4 class="text-blue font-bold">Create a Gist</h4>
                <p class="text-grey-darker py-1">Create a GitHub Gist with Markdown</p>
                <img
                    src="{{ asset('img/step1.jpg') }}"
                    alt="Step 1 - create Gist"
                    class="border border-grey-light rounded shadow-md mt-5"
                >
            </div>
        </div>

        <div class="tab-label mb-5">
            <span>2</span>
            <div class="w-full ml-3 text-sm">
                <h4 class="text-blue font-bold">Paste the Link</h4>
                <p class="text-grey-darker py-1">Paste your Gist's URL into GistLog</p>
                <img
                    src="{{ asset('img/step2.jpg') }}"
                    alt="Step 2 - paste Gist link"
                    class="border border-grey-light rounded shadow-md mt-5"
                >
            </div>
        </div>

        <div class="tab-label">
            <span>3</span>
            <div class="w-full text-sm ml-3">
                <h4 class="text-blue font-bold">Share your Post</h4>
                <p class="text-grey-darker py-1">Share your GistLog link 🎉</p>
                <img
                    src="{{ asset('img/step3.jpg') }}"
                    alt="Step 3 - share your post"
                    class="border border-grey-light rounded shadow-md mt-5"
                >
            </div>
        </div>
    </div>

    <div class="container py-1 mx-auto mb-6">
        <div class="hidden md:flex flex-col md:flex-row justify-around -mx-8">
            <div class="flex flex-col w-full md:w-1/3">
                <div :class="{'tab-label--active': isActive(1) }" class="tab-label" @click="changeTab(1)">
                    <span>1</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Create a Gist</h4>
                        <p class="text-grey-darker py-1 text-sm">Create a GitHub Gist with Markdown</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(2) }" class="tab-label" @click="changeTab(2)">
                    <span>2</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Paste the Link</h4>
                        <p class="text-grey-darker py-1 text-sm">Paste your Gist's URL into GistLog</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(3) }" class="tab-label" @click="changeTab(3)">
                    <span>3</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Share your Post</h4>
                        <p class="text-grey-darker py-1 text-sm">Share your GistLog link 🎉</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center md:w-3/5">
                <img v-if="currentTab == 1" src="{{ asset('img/step1.jpg') }}" alt="Step 1 - create Gist" class="border border-grey-light rounded shadow-lg w-full">
                <img v-if="currentTab == 2" src="{{ asset('img/step2.jpg') }}" alt="Step 2 - paste Gist link" class="border border-grey-light rounded shadow-lg w-full">
                <img v-if="currentTab == 3" src="{{ asset('img/step3.jpg') }}" alt="Step 3 - share your post" class="border border-grey-light rounded shadow-lg w-full">
            </div>
        </div>
    </div>
</div>

<div class="bg-white w-full py-6">
    <div class="container mx-auto text-center pt-4 pb-2">
        <h3 class="text-3xl md:text-4xl font-light text-blue-darkest">Everything you need</h3>
        <div class="w-10 border-solid border-b-2 border-blue-darkest mx-auto my-4"></div>
        <p class="md:w-4/5 mx-auto text-grey-darker-darker leading-normal text-base md:px-8 my-6">GistLog posts may be easy to create, but we didn't skimp on features. All the features you expect from a developer-focused blogging platform, with almost no setup.</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row container mx-auto items-center leading-normal py-12">
    <div class="flex-1 text-center mb-8 md:mb-0">
        <figure class="lg:px-4 sm:mx-8  min-h-6 w-32 sm:w-auto mx-auto">
            <img src="{{ asset('img/icon-responsive.svg') }}" alt="Responsive design - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-blue-darkest text-lg sm:text-base">Responsive out of the box</p>
    </div>

    <div class="flex-1 text-center mb-8 md:mb-0">
        <figure class="lg:px-4 sm:mx-8  min-h-6 w-32 sm:w-auto mx-auto">
            <img src="{{ asset('img/icon-comments.svg') }}" alt="Built-in comments - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-blue-darkest text-lg sm:text-base">Built-in comments &amp; notifications</p>
    </div>

    <div class="flex-1 text-center mb-8 md:mb-0">
        <figure class="lg:px-4 sm:mx-8  min-h-6 w-32 sm:w-auto mx-auto">
            <img src="{{ asset('img/icon-easy.svg') }}" alt="Easy &amp; Fast - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-blue-darkest text-lg sm:text-base">Easy &amp; Fast</p>
    </div>

    <div class="flex-1 text-center">
        <figure class="lg:px-4 sm:mx-8  min-h-6 w-32 sm:w-auto mx-auto">
            <img src="{{ asset('img/icon-markdown.svg') }}" alt="Write with Markdown - {{ config('app.name') }}">
        </figure>
        <p class="text-sm text-blue-darkest text-lg sm:text-base">Write with Markdown</p>
    </div>
</div>
@endsection
