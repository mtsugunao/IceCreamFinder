<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page Title</title>

</head>

<body>
    <h1>みんなの投稿</h1>
    <a href="{{ route('shop.index') }}">お店情報</a>
    @auth
    <div>
        <p>投稿フォーム</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="post-content">投稿</label>
            <span>140字まで</span>
            <textarea id="post-content" type="text" name="post" placeholder="投稿内容を入力"></textarea>
            <input type="file" name="images[]" accept="image/*" multiple>
            @error('images')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <label for="shop_id">アイスクリーム屋さん:</label>
            <select name="shop_id" id="shop_id">
                @foreach ($shops as $shop)
                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
            @error('post')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">投稿</button>
        </form>
    </div>
    @endauth
    <div>
        @foreach($posts as $post)
        <details>
            <summary>{{ $post->comment }} 店の名前:
                <a href="{{ route('shop.detail', ['shopId' => $post->shop->id]) }}">{{ $post->shop->name }}</a>
                ユーザー名: {{ $post->user->name }} 
                作成日: {{ $post->created_at->format('Y.m.d') }}
                @if ($post->images)
                @foreach ($post->images as $image)
                    <?php
                        $path = str_replace('public/', '', $image->name);
                    ?>
                    <img src="{{ asset('storage/' . $path) }}" alt="写真" width="54" height="54">
                @endforeach
                @endif
            </summary>
            @if(\Illuminate\Support\Facades\Auth::id() === $post->user_id)
            <div>
                <a href="{{ route('post.update.index', ['postId' => $post->id]) }}">編集</a>
                <form action="{{ route('post.delete', ['postId' => $post->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
            @else
            編集できません
            @endif
        </details>
        @endforeach
    </div>
</body>

</html>