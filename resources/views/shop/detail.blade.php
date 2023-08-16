<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>お店の登録フォーム</title>

</head>

<body>
    <h1>{{ $shop->name }}</h1>
    <p>住所：{{ $shop->address }}</p>
@auth
    <div>
        <a href="{{ route('shop.update.show', ['shopId' => $shop->id]) }}">編集</a>
        <form action="{{ route('shop.delete', ['shopId' => $shop->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">削除</button>
        </form>
    </div>
@endauth
</body>

</html>