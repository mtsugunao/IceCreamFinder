<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>お店の登録フォーム</title>

</head>

<body>
    <h1>お店情報一覧</h1>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    <div>
        @foreach($shops as $shop)
        <details>
            <summary>{{ $shop->name }} {{ $shop->address }}</summary>
            <div>
                <a href="{{ route('shop.update.index', ['shopId' => $shop->id]) }}">編集</a>
                <form action="{{ route('shop.delete', ['shopId' => $shop->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
        </details>
        @endforeach
    </div>
<a href="/shop/create">お店を追加する</a>
</body>

</html>