<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;

class DetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $shopId = (int) $request->route('shopId');
        $shop = Shop::where('id', $shopId)->firstOrFail();
        return view('shop.detail')->with('shop', $shop);
    }
}
