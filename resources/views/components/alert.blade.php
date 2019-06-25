<div class="max-w-2xl mx-auto js-auto_dismiss mt-10">
    <div class="bg-{{ $color }}-lightest border-t-4 border-{{ $color }} rounded-b text-{{ $color }}-darkest px-4 py-2 shadow-md" role="alert">
        <div class="flex items-center">
            <svg
                class="fill-current h-6 w-6 text-{{ $color }} mr-3"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
            /></svg>

            <p>{{ $message }}</p>
        </div>
    </div>
</div>
