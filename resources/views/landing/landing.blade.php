<!DOCTYPE html>
<html>
    <head>
        <title>Gistlog - Your dev blog delivered</title>
        <link rel="stylesheet" href="{{ asset('css/landing.css' )}}">
        <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400,700">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="author" content="Matt Stauffer">
        <meta name="publisher" content="Matt Stauffer">
        <meta name="copyright" content="Matt Stauffer">
        <meta name="description" content="Your dev blog - delivered! Gistlog allows you to publish your blog posts via simple GitHub gists.">
        <meta name="keywords" content="blog, log, gist, github, developer, post, publishing, simple, easy, fast, share, url, markdown, responsive, free, open, source, os, comments, notifications">
        <meta name="page-topic" content="Developers Publishing">
        <meta name="page-type" content="Blog">
        <meta name="audience" content="All">
        <meta http-equiv="content-language" content="en-us">
        <meta name="robots" content="index, follow">
        <meta name="DC.Creator" content="Matt Stauffer">
        <meta name="DC.Publisher" content="Matt Stauffer">
        <meta name="DC.Rights" content="Matt Stauffer">
        <meta name="DC.Description" content="Your dev blog - delivered! Gistlog allows you to publish your blog posts via simple GitHub gists.">
        <meta name="DC.Language" content="en-us">
    </head>
    <body>
        @include('landing.nav')
        @include('landing.intro')
        @include('landing.instructions')
        @include('landing.features')
        @include('landing.bottom-cta')
        @include('landing.footer')
    </body>
</html>
