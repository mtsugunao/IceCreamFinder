<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>お店の登録フォーム</title>

</head>

<body>
    <h1>お店情報を編集する</h1>
    <div>
        <a href="{{ route('shop.index') }}">戻る</a>
        <p>登録フォーム</p>
        @if (session('feedback.success'))
        <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('shop.update.put', ['shopId' => $shop->id]) }}" method="post">
            @method('PUT')
            @csrf
            <label for="shop-name">名前</label>
            <textarea id="shop-name" type="text" name="name" placeholder="お店の名前を入力">{{ $shop->name }}</textarea>
            <label for="shop-address">住所</label>
            <textarea id="shop-address" type="text" name="address" placeholder="お店の住所を入力">{{ $shop->address }}</textarea>
            @error('name')
            <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
            @enderror
            @error('address')
            <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
            @enderror
            <button type="submit">編集</button>
        </form>
    </div>
</body>

</html>