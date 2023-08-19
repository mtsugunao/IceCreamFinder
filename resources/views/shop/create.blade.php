<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>お店の登録フォーム</title>
</head>

<body>
    <p>登録フォーム</p>
    <form action="{{ route('shop.store') }}" method="post">
        @csrf
        <label for="shop-name">名前</label>
        <textarea id="shop-name" type="text" name="name" placeholder="お店の名前を入力">{{ old('name') }}</textarea>
        <label for="shop-address">住所</label>
        <textarea id="shop-address" type="text" name="address" placeholder="お店の住所を入力">{{ old('address') }}</textarea>
        @error('name')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        @error('address')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        <div id="menu-fields">
            <!-- ここにメニューフィールドが追加される -->
        </div>
        @error('menu_name.*')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        @error('menu_price.*')
        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
        @enderror
        <button type="button" id="add-menu">メニュー追加</button>
        <button type="submit">送信</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addMenuButton = document.getElementById('add-menu');
            const menuFieldsContainer = document.getElementById('menu-fields');

            addMenuButton.addEventListener('click', function() {
                const newMenuField = document.createElement('div');
                newMenuField.className = 'menu-field';
                newMenuField.innerHTML = `
                <input type="text" name="menu_name[]" placeholder="メニュー名" value= "{{ old('menu_name[]') }}">
                <input type="text" name="menu_price[]" placeholder="価格" value="{{ old('menu_price[]') }}">
                <button type="button" class="remove-menu">削除</button>
            `;

                menuFieldsContainer.appendChild(newMenuField);

                // 削除ボタンのクリックイベントを設定
                const removeButtons = menuFieldsContainer.querySelectorAll('.remove-menu');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        button.closest('.menu-field').remove();
                    });
                });
            });
        });
    </script>
</body>

</html>