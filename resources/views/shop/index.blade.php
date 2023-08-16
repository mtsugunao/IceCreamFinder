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
            <a href="{{ route('shop.detail', ['shopId' => $shop->id]) }}">{{ $shop->name }} {{ $shop->address }}</a>
        @endforeach
    </div>
@auth
<a href="{{ route('shop.create') }}">お店を追加する</a>
@endauth
</body>

</html>