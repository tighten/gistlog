@extends('layouts.error')

@section('title')
    404! Request not found
@endsection

@section('content')
<style>
    .title {
        display: none;
    }
    .button-container {
        margin: 20px 0;
        text-align: center;
    }
    .button {
        border: 1px solid #555;
        display: inline-block;
        min-width: 150px;
        padding: 10px 20px;
        text-decoration: none;
    }
    .button:hover {
        background: #eee;
    }
</style>

    <h1>Unable to find your request</h1>
    <div class="button-container">
        <a href="{{ route('home') }}" class="button">Go back home</a>
        @if ($gistId && $username)
            <a href="{{ route('authors.show', ['username' => $username]) }}" class="button">Go to author page</a>
        @endif
    </div>
    <p><strong>Or enjoy this instead</strong></p>
    <iframe width="420" height="315" src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?rel=0" frameborder="0" allowfullscreen></iframe>
@endsection
