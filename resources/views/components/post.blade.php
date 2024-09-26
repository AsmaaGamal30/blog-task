<div>
    <h3>
        {{ $username }}:
        @if ($isLink && $postId)
            <a href="{{ route('post.show', $postId) }}" class="post-title">{{ $title }}</a>
        @else
            {{ $title }}
        @endif
    </h3>
    @if (!empty($image))
        <img src="{{ $image }}" alt="Post Image" class="post-image">
    @endif


    <p>{{ $body }}</p>
</div>
