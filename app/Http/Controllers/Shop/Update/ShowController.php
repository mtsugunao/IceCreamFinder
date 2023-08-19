<?php

namespace App\Http\Controllers\Shop\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Menu;
class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $shopId = (int) $request->route('shopId');
        $shop = Shop::where('id', $shopId)->firstOrFail();
        $menus = Menu::where('shop_id', $shopId)->get();
        return view('shop.update')->with('shop', $shop)->with('menus', $menus);
    }
}
