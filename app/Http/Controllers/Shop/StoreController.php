<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CreateRequest;
use App\Models\Shop;
use App\Models\Menu;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request)
    {
        $shop = new Shop;
    
        $shop->name = $request->shopName();
        $shop->address = $request->address();
        $shop->save();  // 店舗情報を保存して id を生成
    
        $menuNames = $request->menu();
        $menuPrices = $request->price();
    
        // メニュー情報を保存
        foreach ($menuNames as $index => $menuName) {
            if (!empty($menuName)) {
                $menu = new Menu();
                $menu->name = $menuName;
                $menu->price = $menuPrices[$index];
                $menu->shop_id = $shop->id;  // ここで shop_id を設定
                $menu->save();
            }
        }
    
        return redirect()->route('shop.index')->with('success.feedback', '店舗情報とメニューを保存しました。');
    }
}
