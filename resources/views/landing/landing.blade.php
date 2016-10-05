<!DOCTYPE html>
<html>
    <head>
        <title>Gistlog - Your dev blog delivered</title>
        <link rel="stylesheet" href="{{asset('css/landing.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    </head>
    <body>
        @include('landing.nav')
        @include('landing.intro')
        @include('landing.instructions')
        @include('landing.features')
        @include('landing.footer')
    </body>
</html>