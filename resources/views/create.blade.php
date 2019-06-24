@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto mt-20">
        <p class="text-blue-darkest text-base text-center mt-8 mb-3">Paste the URL to a Gist here to create a GistLog</p>

        <form method="POST" action="{{ route('post.create') }}" class="shadow flex flex-1 mb-8">
            {{ csrf_field() }}

            <input
                type="text"
                name="gistUrl"
                class="bg-white w-4/5 py-3 rounded-tl rounded-bl text-grey text-sm px-4 focus:outline-none" placeholder="https://gist.github.com/username/gist-id">

            <button
                class="bg-blue-darkest flex-1 py-3 text-white rounded-tr rounded-br text-sm sm:text-base"
            >Create</button>
        </form>

        <div class="bg-grey-lighter rounded mt-1 py-4 px-4">
            <p class="text-sm text-blue-darkest pt-1">Just want to test drive?</p>
            <p class="text-sm my-4 w-5/6 text-grey-darker text-center w-full leading-normal">
                Try this gist (just copy the URL, paste it above) to see how GistLog works and also to learn a little bit more about what GistLog is:
            </p>

            <input
                type="text"
                id="example-snippet"
                class="bg-white w-full py-3 text-grey text-sm px-4 rounded border border-grey-light focus:border-grey focus:outline-none" value="https://gist.github.com/mattstauffer/1c76d40371b295184845"
                onclick="copyToClipboard()"
            >

            <small id="copy-successful" class="block invisible text-grey-darker text-right my-1">Copied to clipboard</small>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard(element) {
        let snippet = document.getElementById('example-snippet');
        let successMessage = document.getElementById('copy-successful');

        snippet.select();
        document.execCommand('copy');

        if (successMessage.classList.contains('invisible')) {
            document.getElementById('copy-successful').classList.toggle('invisible');
        }
    }
</script>
@endsection
