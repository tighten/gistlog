<!DOCTYPE html>
<html>
    <head>
        <title>Gistlog - Your dev blog delivered</title>
        <link rel="stylesheet" href="{{asset('css/landing.css')}}">
        <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400,700">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    </head>
    <body>
        @include('landing.nav')
        @include('landing.intro')
        @include('landing.instructions')
        @include('landing.features')
        @include('landing.footer')
    </body>
</html>