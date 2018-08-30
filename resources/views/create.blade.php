@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <div class="text-center max-w-sm mx-auto">
        <nav class="mx-auto w-2/5">
            <a href="/" title="GistLog by Tighten" class="w-full flex items-center text-blue-darker no-underline">
                <img width="50px" src="{{ asset('img/gistlog-logo.svg') }}" class="float-left mr-2">
                <h2 class="font-thin"><span class="font-bold">Gist</span>Log</h2>
            </a>
        </nav>

        <p class="text-blue-darkest text-base mt-8 mb-3">Paste the URL to a Gist here to create a GistLog</p>

        <div class="flex px-4">
            <form method="POST" action="{{ route('post.create') }}" class="shadow flex flex-1 mb-8">
                {{ csrf_field() }}
                <input type="text" name="gistUrl" class="bg-white w-4/5 py-3 rounded-tl rounded-bl text-grey text-sm px-4" placeholder="https://gist.github.com/username/gist-id">
                <button class="bg-blue-darkest flex-1 py-3 text-white rounded-tr rounded-br text-sm sm:text-base">Create</button>
            </form>
        </div>

        <div class="px-4">
            <div class="bg-grey-lighter rounded mt-1 py-4 px-4">
                <p class="text-sm text-blue-darkest">Just want to test drive?</p>
                <p class="text-sm my-4 w-5/6 text-grey text-center w-full leading-normal">
                    Try this gist (just copy the URL, paste it above) to see how GistLog works and also to learn a little bit more about what GistLog is:
                </p>
                <input type="text" class="bg-white w-full py-3 text-grey text-sm px-4 rounded border border-solid border-grey-light" value="https://gist.github.com/mattstauffer/1c76d40371b295184845">
            </div>
        </div>
    </div>
</div>
@endsection
