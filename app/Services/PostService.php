<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService {
    public function checkOwnPost(int $userId, int $postId): bool {
        $post = Post::where('id', $postId)->firstOrFail();
        if(!$post){
            return false;
        }
        return $post->user_id === $userId;
    }

    public function getPost() {
        return Post::with('images')->orderBy('created_at', 'DESC')->get();
    }

    public function savePost(int $userId, string $comment, int $shop_id, $images){
        DB::transaction(function () use ($userId, $comment, $shop_id, $images) {
            $post = new Post;
            $post->user_id = $userId;
            $post->comment = $comment;
            $post->shop_id = $shop_id;
            $post->save();
            foreach($images as $image){
                $path = Storage::putFile('public/images', $image);
                $imageModel = new Image;
                $imageModel->name = $path;
                $imageModel->save();
                $post->images()->attach($imageModel->id);
            }
        });
    }

    //投稿を削除する
    public function deletePost(int $postId){
        DB::transaction(function () use ($postId) {
            $post = Post::where('id', $postId)->firstOrFail();
            $post->images()->each(function ($image) use ($post){
                $filePath = $image->name;
                if(Storage::exists($filePath)){
                    Storage::delete($filePath);
                }
                $post->images()->detach($image->id);
                $image->delete();
            });
            $post->delete();
        });
    }
}