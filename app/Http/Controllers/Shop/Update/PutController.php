<?php

namespace App\Http\Controllers\Shop\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Shop\UpdateRequest;
use App\Models\Shop;

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
        return redirect()->route('shop.update.index', ['shopId' => $shop->id])->with('feedback.success', "お店情報を編集しました");
    }
}
