<div class="flex my-6">
    <div class="w-12 h-12 rounded-full overflow-hidden">
        <img src="{{ $comment->avatarUrl }}" alt="{{ $comment->author }} - {{ config('app.name') }}">
    </div>
    <div class="flex-1 flex flex-col px-2 sm:pl-4 sm:p-0">
        <span class="text-blue text-sm font-normal">
            <a href="https://github.com/{{ $comment->author }}" target="_blank" class="no-underline">{{ $comment->author }}</a>
            &bull; <a href="{{ $comment->link() }}" class="no-underline"
                >{{ $comment->updatedAt->diffForHumans() }}</a>
        </span>
        <span class="font-normal text-sm leading-normal text-justify">
                {!! $comment->renderHtml() !!}
        </span>
    </div>
</div>
