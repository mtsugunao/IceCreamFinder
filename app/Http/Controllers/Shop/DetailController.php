<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Menu;

class DetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $shopId = (int) $request->route('shopId');
        $shop = Shop::where('id', $shopId)->firstOrFail();
        $menus = Menu::where('shop_id', $shopId)->get();
        return view('shop.detail')->with('shop', $shop)->with('menus', $menus);
    }
}
