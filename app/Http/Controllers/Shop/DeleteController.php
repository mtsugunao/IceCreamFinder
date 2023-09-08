<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $shopId = (int) $request->route('shopId');
        $shop = Shop::where('id', $shopId)->firstOrFail();
        $shop->delete();
        return redirect()->route('shop.index')->with('feedback.success', "お店情報を削除しました");
    }
}
