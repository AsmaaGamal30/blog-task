@extends('layouts.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Show Post')

@section('content')
    <div class="post-details">
        <x-post username="{{ $post->user->username }}" title="{{ $post->title }}"
            image="{{ !empty($post->image) ? Storage::url($post->image) : '' }}" body="{{ $post->body }}"
            :isLink="false" />

        <!-- Comment Form -->
        <div class="comment-form">
            <form id="commentForm">
                @csrf
                <input name="user_id" id="user_id" type="hidden" value="{{ Auth::id() }}" />
                <input name="post_id" id="post_id" type="hidden" value="{{ $post->id }}" />
                <label for="comment">Add a Comment:</label>
                <input type="text" id="comment" name="comment" placeholder="Enter your comment here..." required>
                <button type="submit" class="btn">Add Comment</button>
            </form>
        </div>

        <!-- Comment Section -->
        <div id="comments-section">
            <h4>Comments:</h4>
            @foreach ($post->comments as $comment)
                <x-comment username="{{ $comment->user->username }}" content="{{ $comment->comment }}" />
            @endforeach
        </div>

        <script>
            document.getElementById('commentForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                let formData = new FormData(this);

                fetch("{{ route('comments.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const commentsSection = document.getElementById('comments-section');
                            const newComment = document.createElement('div');
                            newComment.innerHTML =
                                `<x-comment username="${data.comment.user}" content="${data.comment.body}" />`;
                            commentsSection.appendChild(newComment);

                            document.getElementById('comment').value = ''; // Clear comment input
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            const postId = document.getElementById('post_id').value;

            window.Echo.channel('post-comments.' + postId)
                .listen('CommentPosted', (e) => {
                    const commentsSection = document.getElementById('comments-section');
                    const newComment = document.createElement('div');
                    newComment.innerHTML =
                        `<x-comment username="${e.comment.user}" content="${e.comment.body}" />`;
                    commentsSection.appendChild(newComment);
                });
        </script>
    </div>
@endsection
