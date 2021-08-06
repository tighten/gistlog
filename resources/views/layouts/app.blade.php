<!DOCTYPE html>
<html lang="en">
<head>
    @if (config('app.env') == 'production')
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-40114814-7', 'auto');
            ga('send', 'pageview');
        </script>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="en-us">
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }} GistLog - Your dev blog delivered</title>

    @yield('meta')

    @if (isset($gistlog) && $gistlog->isSecret())
        <meta name="robots" content="noindex, nofollow">
    @endif

    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:100,300,400,700">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css">
    <link href="/css/app.css" rel="stylesheet">

    @yield('styles')

    @routes()
</head>
<body class="font-sans border-t-8 border-blue-darker bg-grey-lightest">
    <div class="flex flex-col h-screen">
        <div id="app" class="flex-auto">
            <nav class="container mx-auto mt-4">
                <a
                    href="/"
                    title="GistLog by Tighten"
                    class="flex items-center w-full no-underline text-blue-darker"
                >
                    <img
                        width="50px"
                        src="{{ asset('img/gistlog-logo.svg') }}"
                        alt="GistLog logo."
                        class="mr-2"
                    >
                    <h1 class="text-2xl"><span class="font-bold">Gist</span>Log</h1>
                </a>
            </nav>

            @include('partials.flash-messages')

            @yield('content')
        </div>

        <div class="flex flex-col items-center justify-center py-4 mt-4 text-xs text-white lg:flex-row bg-grey-darkest md:text-sm">
            <div>
                <a href="/" class="no-underline text-blue-lighter hover:text-white">GistLog</a>
                &copy; {{ Carbon\Carbon::now()->format('Y') }}
                <span class="hidden lg:inline-block">|&nbsp;</span>
            </div>

            <div>
                Brought to you by the lovely humans at
                <a href="https://tighten.co" class="no-underline text-blue-lighter hover:text-white">Tighten</a>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
    @stack('scripts')
</body>
</html>
