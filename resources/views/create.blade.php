@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <div class="text-center max-w-sm mx-auto">
        <div class="mx-auto px-4 py-4">
            <nav class="flex">
                <img width="110px" class="mx-auto" src="{{ asset('/tailwind/img/logo.svg') }}">
            </nav>
        </div>
        <p class="text-blue-darkest text-base mt-8 mb-3">Paste the URL to a Gist here to create Gistlog</p>
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
                    Try this gist (just copy the URL, paste it above) to see how Gistlog works and also to learn a little bit more about what Gistlog is:
                </p>
                <input type="text" class="bg-white w-full py-3 text-grey text-sm px-4 rounded border border-solid border-grey-light" value="https://gist.github.com/mattstauffer/1c76d40371b295184845">
            </div>
        </div>
    </div>
</div>
@endsection