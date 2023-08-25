<?php

namespace App\Services;

use App\Models\Post;

class PostService {
    public function checkOwnPost(int $userId, int $postId): bool {
        $post = Post::where('id', $postId)->firstOrFail();
        if(!$post){
            return false;
        }
        return $post->user_id === $userId;
    }

    public function getPost() {
        return Post::orderBy('created_at', 'DESC')->get();
    }
}