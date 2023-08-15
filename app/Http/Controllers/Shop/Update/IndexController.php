<?php

namespace App\Http\Controllers\Shop\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $shopId = (int) $request->route('shopId');
        $shop = Shop::where('id', $shopId)->firstOrFail();
        return view('shop.update')->with('shop', $shop);
    }
}
