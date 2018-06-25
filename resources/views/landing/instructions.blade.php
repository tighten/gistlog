<div class=" bg-grey-lightest w-full pt-8 pb-6">
    <div class="container mx-auto text-center pt-3 pb-2">
        <h2 class="mt-6 text-blue-darkest">How it works</h2>
        <div class="title-underline"></div>
        <p class="md:w-4/5 mx-auto text-grey leading-normal text-base md:px-8 my-6">In just a few steps&mdash;and just a few seconds&mdash;you can be blogging using nothing but simple GitHub Gists and Markdown.</p>
    </div>
    <div class="container py-1 mx-auto mb-6">
        <div class="flex flex-col md:flex-row justify-between">
            {{-- Steps list --}}
            <div class="flex-1 px-1 flex-col">
                <div class="flex flex-1 bg-white rounded-lg shadow-md my-4 py-5 px-5">
                    <div class="rounded-full font-bold text-white w-8 h-8 bg-blue flex items-center justify-center text-sm">1</div>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Create a Gist</h4>
                        <p class="text-grey py-1 text-sm">Create a GitHub Gist with Markdown</p>
                    </div>
                </div>
                <div class="flex flex-1 my-4 py-5 px-5">
                    <div class="rounded-full py-2 font-bold text-white w-8 h-8 bg-blue-darkest flex items-center justify-center text-sm">2</div>
                    <div class="text-left mx-5">
                        <h4 class="text-blue-darker font-bold text-sm">Paste the Link</h4>
                        <p class="text-grey py-1 text-sm">Paste your Gist's URL into GistLog</p>
                    </div>
                </div>
                <div class="flex flex-1 my-4 py-5 px-5">
                    <div class="rounded-full py-2 font-bold text-white w-8 h-8 bg-blue-darkest flex items-center justify-center text-sm">3</div>
                    <div class="text-left mx-5">
                        <h4 class="text-blue-darker font-bold text-sm">Share Your Post</h4>
                        <p class="text-grey py-1 text-sm">Share your GistLog link (and celebrate!)</p>
                    </div>
                </div>
            </div>
            {{-- Form box --}}
            <div class="flex-1 pr-1 px-1 md:pl-6">
                <div class="my-4 pt-8 pb-2 rounded shadow-lg bg-white border-blue-darker border-t-4">
                    <img class="table py-6 mx-auto" width="110px" src="{{ asset('img/logo.svg') }}">

                    <p class="px-6 text-blue-darker pt-5 pb-4 text-sm">Paste the URL to a Gist here to create a GistLog</p>

                    <form class="flex pr-1" method="POST" action="{{ route('post.create') }}">
                        {{ csrf_field() }}
                        <input class="appearance-none border-solid border-t-2 border-b-2 flex-1 text-sm border-l-none py-2 px-3 text-grey" type="text" value="{{ old('gistUrl') }}" name="gistUrl" placeholder="https://gist.github.com/username/gist-id">
                        <button class="bg-blue-darker w-32 py-3 hover:bg-blue-dark text-white font-bold text-sm py-2 px-4" type="submit">
                            Create
                        </button>
                    </form>

                    <div class="py-4 mt-8 bg-grey-lightest flex flex-col">
                            <p class="px-4 text-blue-darker text-center mb-4 text-sm">
                                Just want to test drive?
                            </p>
                            <p class="px-4 text-grey font-hairline mb-4 text-sm">
                                Copy and paste the following link in the form above
                            </p>
                        <input class="appearance-none text-sm border-solid border-t-2 border-b-2 flex-1 border-l-none py-2 px-3 text-grey" type="text" value="https://gist.github.com/mattstauffer/1c76d40371b295184845">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
