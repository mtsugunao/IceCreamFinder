<!DOCTYPE html>
<html lang="ja">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Page Title</title>

</head>

<body>
	<h1>みんなの投稿</h1>
    <div>
        <a href="{{ route('post.show') }}">戻る</a>
        <p>投稿フォーム</p>
        @if(session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('post.update.put', ['postId' => $post->id]) }}" method="post">
            @method('PUT')
            @csrf
            <label for="post-content">投稿</label>
            <span>140字まで</span>
            <textarea id="post-content" type="text" name="post" placeholder="投稿内容を入力">{{ $post->comment }}</textarea>
            @error('post')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">編集</button>
        </form>
    </div>
</body>
</html>