<!DOCTYPE html>
<html lang="en">
<head>
    @if (env('APP_ENV') == 'production')
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
    <title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }} GistLog - Your dev blog delivered</title>

    @yield ('meta')

    @if (isset($gistlog) && $gistlog->isSecret())
        <meta name="robots" content="noindex, nofollow">
    @endif

    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:100,300,400,700">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css">
    <link href="/css/app.css" rel="stylesheet">

    @yield('styles')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="flex flex-col h-full">
        <div id="vue-app" class="flex-auto">
            <nav class="container mx-auto mt-4">
                <a href="/" title="GistLog by Tighten" class="w-full flex items-center text-blue-darker no-underline">
                    <img width="50px" src="{{ asset('img/gistlog-logo.svg') }}" class="mr-2">
                    <h2 class="text-2xl"><span class="font-bold">Gist</span>Log</h2>
                </a>
            </nav>

            @include('partials.flash-messages')

            @yield('content')
        </div>

        <div class="flex flex-col lg:flex-row bg-grey-darkest justify-center items-center text-xs md:text-sm text-white mt-4 py-4">
            <div>
                <a href="/" class="text-blue-light no-underline hover:text-white">GistLog</a>
                &copy; {{ Carbon\Carbon::now()->format('Y') }}
                <span class="hidden lg:inline-block">|&nbsp;</span>
            </div>
            <div>
                Brought to you by the lovely humans at
                <a href="https://tighten.co" class="text-blue-light no-underline hover:text-white">Tighten</a>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
    @yield('scripts')
</body>
</html>
