<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>お店の登録フォーム</title>

</head>

<body>
    <p>登録フォーム</p>
    <form action="{{ route('shop.shop') }}" method="post">
        @csrf
        <label for="shop-name">名前</label>
        <textarea id="shop-name" type="text" name="name"
        placeholder="お店の名前を入力"></textarea>
        <label for="shop-address">住所</label>
        <textarea id="shop-address" type="text" name="address"
        placeholder="お店の住所を入力"></textarea>
        @error('name')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        @error('address')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        <button type="submit">送信</button>
    </form>
</body>

</html>