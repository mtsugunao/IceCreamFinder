<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CreateRequest;
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request)
    {
        $shop = new Shop;
        $shop->name = $request->shopName();
        $shop->address = $request->address();
        $shop->save();
        return redirect()->route('shop.index');
    }
}
