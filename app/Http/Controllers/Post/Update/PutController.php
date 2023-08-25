<?php

namespace App\Http\Controllers\Post\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, PostService $postService)
    {
        //checkOwnPostはログインしているユーザーが投稿したか確認するメソッド
        if(!$postService->checkOwnPost($request->user()->id, $request->id())){
            throw new AccessDeniedHttpException();
        }
        $post = Post::where('id', $request->id())->firstOrFail();
        $post->comment = $request->postContent();
        $post->save();
        return redirect()->route('post.update.index', ['postId' => $post->id])->with('feedback.success', "投稿内容を変更しました");
    }
}
