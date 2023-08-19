<?php

namespace App\Http\Controllers\Shop\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Shop\UpdateRequest;
use App\Models\Shop;
use App\Models\Menu;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {
        $shop = Shop::where('id', $request->id())->firstOrFail();
        $shop->name = $request->shopName();
        $shop->address = $request->address();
        $shop->save();

        $menus = $shop->menus; // 店舗に関連するメニューレコードを取得
        $menuIds = $menus->pluck('id')->toArray(); // メニューのIDを配列に変換
        $menuNames = $request->menu();
        $menuPrices = $request->price();

        // ここでメニューを編集か新規作成する処理を分けてる
        foreach ($menuNames as $index => $menuName) {
            if (isset($menuIds[$index]) && !empty($menuName)) {
                $menu = Menu::findOrNew($menuIds[$index]);
                $menu->name = $menuName;
                $menu->price = $menuPrices[$index];
                $menu->save();
            } else {
                if (!empty($menuName)) {
                    $menu = new Menu();
                    $menu->name = $menuName;
                    $menu->price = $menuPrices[$index];
                    $menu->shop_id = $shop->id;
                    $menu->save();
                }
            }
        }
        
        return redirect()->route('shop.update.show', ['shopId' => $shop->id])->with('feedback.success', "お店情報を編集しました");
    }
}
