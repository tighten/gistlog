<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-language" content="en-us">

        <title>GistLog - Your dev blog delivered</title>

        <link rel="stylesheet" href="{{ asset('css/landing.css' )}}">
        <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400,700">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

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
