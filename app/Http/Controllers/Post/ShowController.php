<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Shop;
use App\Services\PostService;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, PostService $postService)
    {
        $posts = $postService->getPost(); //投稿された順に表示
        $shops = Shop::all();
        return view('post.show')->with('posts', $posts)->with('shops', $shops);
    }
}
