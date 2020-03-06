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

    <div class="flex flex-wrap -mx-1">
        <a href="/posts/create" class="inline-block bg-blue-darker text-white md:text-lg rounded focus:outline-none m-1 py-2 px-6">
            Get Started
        </a>

        <a href="/auth/github" class="inline-flex items-center bg-blue-darker text-white md:text-lg rounded focus:outline-none m-1 py-2 px-6">
            <span class="w-6 mr-2 fill-current text-white">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1024 1024" enable-background="new 0 0 1024 1024" xml:space="preserve">
                    <path d="M512 0C229.25 0 0 229.25 0 512c0 226.25 146.688 418.125 350.156 485.812 25.594 4.688 34.938-11.125 34.938-24.625 0-12.188-0.469-52.562-0.719-95.312C242 908.812 211.906 817.5 211.906 817.5c-23.312-59.125-56.844-74.875-56.844-74.875-46.531-31.75 3.53-31.125 3.53-31.125 51.406 3.562 78.47 52.75 78.47 52.75 45.688 78.25 119.875 55.625 149 42.5 4.654-33 17.904-55.625 32.5-68.375C304.906 725.438 185.344 681.5 185.344 485.312c0-55.938 19.969-101.562 52.656-137.406-5.219-13-22.844-65.094 5.062-135.562 0 0 42.938-13.75 140.812 52.5 40.812-11.406 84.594-17.031 128.125-17.219 43.5 0.188 87.312 5.875 128.188 17.281 97.688-66.312 140.688-52.5 140.688-52.5 28 70.531 10.375 122.562 5.125 135.5 32.812 35.844 52.625 81.469 52.625 137.406 0 196.688-119.75 240-233.812 252.688 18.438 15.875 34.75 47 34.75 94.75 0 68.438-0.688 123.625-0.688 140.5 0 13.625 9.312 29.562 35.25 24.562C877.438 930 1024 738.125 1024 512 1024 229.25 794.75 0 512 0z" />
                </svg>
            </span>
            Sign in with GitHub
        </a>
    </div>
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

    <home-page-tabs></home-page-tabs>
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
