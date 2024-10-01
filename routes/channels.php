<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post-comments.{postId}', function ($user, $postId) {
    return $user !== null;
});
