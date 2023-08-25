<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\CreateRequest;
use App\Models\Post;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request)
    {
        $post = new Post;
        $post->user_id = $request->userId();
        $post->comment = $request->postContent();
        $post->shop_id = $request->shopId();
        $post->save();
        return redirect()->route('post.show');
    }
}
