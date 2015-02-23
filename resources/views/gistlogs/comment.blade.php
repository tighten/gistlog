<div class="comment">
    <div class="comment__avatar">
        <img src="{{ $comment->avatarUrl }}">
    </div>

    <div class="comment__content">
        <div class="comment__meta">
            <a href="https://github.com/{{ $comment->author }}">{{ $comment->author }}</a>
            commented {{ $comment->updatedAt->diffForHumans() }}
        </div>
        <div class="comment__body">
            {!! $comment->renderHtml() !!}
        </div>
    </div>
</div>
