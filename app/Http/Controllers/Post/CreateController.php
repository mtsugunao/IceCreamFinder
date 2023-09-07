<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateRequest;
use App\Models\Post;
use App\Services\PostService;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, PostService $postService)
    {
        $postService->savePost(
            $request->userId(),
            $request->postContent(),
            $request->shopId(),
            $request->images()
        );
        return redirect()->route('post.show');
    }
}
